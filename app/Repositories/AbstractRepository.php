<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AbstractRepository
{
    const DEFAULT_SORT_FIELD = 'id';

    const DEFAULT_SORT_DIRECTION = 'desc';

    protected Builder $builder;

    protected array $columns;

    private string $searchParam = 'searchKeyword';

    private string $perPageParam = 'perPage';

    private string $sortFieldParam = 'sortField';

    private string $sortDirectionField = 'direction';

    private string $sortField;

    private string $sortDirection;

    private ?string $searchQuery;

    private int $perPageQuantity;

    public function __construct()
    {
        $this->searchQuery = request($this->searchParam);
        $this->perPageQuantity = request($this->perPageParam, 10);
        $this->sortField = request($this->sortFieldParam, self::DEFAULT_SORT_FIELD);
        $this->sortDirection = request($this->sortDirectionField, self::DEFAULT_SORT_DIRECTION);
    }

    /**
     * Метод возвращает запрос в базу данных, который может фильтровать или
     * запрашивать связи перед тем, как использовать пагинацию.
     * @param Builder $builder
     * @return AbstractRepository
     */
    protected function setBuilder(Builder $builder): AbstractRepository
    {
        $this->builder = $builder;

        return $this;
    }

    protected function setSearchColumns(array $columns): AbstractRepository
    {
        $this->columns = $columns;

        return $this;
    }

    private function filterQuery(): Builder
    {
        return $this->builder
            ->when(request('searchKeyword'), function ($query) {
                foreach ($this->columns as $key => $columns) {
                    $query->where(function ($query) use ($columns, $key) {
                        foreach ($columns as $column) {
                            if ($key === 'baseTableColumnsSearch') {
                                /**
                                 * Если в названии столбца есть точка, то нужно разделить их на связь и название столбца для
                                 * фильтрации по связи/json столбцу (тип в бд)
                                 */
                                if (Str::contains($column, '.')) {
                                    [$column, $relations] = $this->sliceColumnAndRelation($column);
                                    $this->queryRelationOrJsonColumn($query, $relations, $column);
                                } else {
                                    $query->orWhere($column, 'LIKE', "%$this->searchQuery%");
                                }
                            }
                        }
                    });
                }
            })
            ->when(request()->filled('fields'), function ($query) {
                foreach (request('fields') as $field => $value) {
                    if (!in_array($field, $this->columns['baseTableColumnsSearchByKey'] ?? [])) {
                        continue;
                    }

                    $query->where(function ($query) use ($field, $value) {
                        if (Str::contains($field, '.')) {
                            [$column, $relations] = $this->sliceColumnAndRelation($field);
                            $this->queryRelationOrJsonColumn($query, $relations, $column, $value);
                        } else {
                            $query->orWhere($field, 'LIKE', "%$value%");
                        }
                    });
                }
            })
            ->when(request()->filled('dateComparison'), function ($query) {
                $operators = ['lt' => '<', 'lte' => '<=', 'gt' => '>', 'gte' => '>='];

                foreach (request('dateComparison') as $operator => $range) {
                    if (! array_key_exists($operator, $operators)) continue;

                    foreach ($range as $field => $value) {
                        if (! in_array($field, $this->columns['dateComparison'] ?? [])) {
                            continue;
                        }

                        $query->where($field, $operators[$operator], $value);
                    }
                }
            })
            ->when(isset($this->columns['select']), function ($query) {
                $query->addSelect($this->columns['select']);
            })
            ->when(request()->filled('filters'), function ($query) {
                $this->filterSearch($query);
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    protected function checkOrderFieldAndDirection(): self
    {
        if (! in_array($this->sortField, Schema::getColumnListing($this->builder->getModel()->getTable()))) {
            $this->sortField = self::DEFAULT_SORT_FIELD;
        }

        if (! in_array($this->sortDirection, ['asc', 'desc'])) {
            $this->sortDirection = self::DEFAULT_SORT_DIRECTION;
        }

        return $this;
    }

    protected function getPaginatedSearchResult(): LengthAwarePaginator
    {
        return $this->checkOrderFieldAndDirection()
            ->filterQuery()
            ->paginate($this->perPageQuantity);
    }

    protected function getAll(): Collection
    {
        return $this->checkOrderFieldAndDirection()
            ->filterQuery()
            ->get();
    }

    private function queryRelationOrJsonColumn(Builder $query, $relations, $column, $value = null): void
    {
        $searchQuery = $value ?? $this->searchQuery;
        /**
         * Для фильтрации по связи сущности, необходимо реализовать метод с названием $relation ($relation - это
         * название столбца до первой точки, который указан в TableConfig)
         */
        if (method_exists($this->builder->getModel(), explode('.', $relations)[0])) {
            $query->orWhereRelation($relations, $column, 'LIKE', "%$searchQuery%");
        }

        else {
            $query->orWhere($relations . '.' . $column,  "LIKE", "%$searchQuery%");
        }
    }

    private function filterSearch(Builder $query): void
    {
        foreach (request('filters') as $column => $value) {

            if (! Str::contains($column, '.') && ! in_array($column, Schema::getColumnListing($query->getModel()->getTable()))) {
                continue;
            }
            /**
             * Если значение пустое, то нужно перейти к следующей итерации
             */
            if ($value === null) {
                continue;
            }

            $method = is_array($value) ? 'whereIn' : 'where';
            /**
             * Если в столбце есть точка, то нужно фильтровать по связи либо по join
             */
            if (Str::contains($column, '.')) {
                $this->filterQueryRelationOrJson($column, $query, $value, $method);
            }
            /**
             * Иначе нужно использовать обычный фильтр
             */
            else {
                $query->{$method}($column, $value);
            }
        }
    }

    /**
     * @param $column
     * @param Builder $query
     * @param $value
     * @return mixed|string
     */
    private function filterQueryRelationOrJson($column, Builder $query, $value, $method)
    {
        [$column, $relations] = $this->sliceColumnAndRelation($column);

        /** Если связь */
        if (method_exists($query->getModel(), explode('.', $relations)[0])) {
            $query->whereHas($relations, function ($q) use ($column, $value, $method) {
                $q->{$method}($column, $value);
            });
        }

        return $column;
    }

    /**
     * @param $column
     * @return array
     */
    private function sliceColumnAndRelation($column): array
    {
        $relationWithColumn = explode('.', $column);
        $column = end($relationWithColumn);
        $relations = array_splice($relationWithColumn, 0, count($relationWithColumn) - 1);

        return array($column, implode('.', $relations));
    }
}
