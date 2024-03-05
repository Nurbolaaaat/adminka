<?php

namespace App\Repositories;

use App\DTO\CreatePostDto;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Random\RandomException;

class PostRepository extends AbstractRepository
{
    private function getTableQuery(): Builder
    {
        return Post::query();
    }

    private function getSearchColumns(): array
    {
        return [
            'baseTableColumnsSearchByKey' => [
                'title',
                'body'
            ]
        ];
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->setBuilder(
            $this->getTableQuery()->with('user')
        )->setSearchColumns(
            $this->getSearchColumns()
        )->getPaginatedSearchResult();
    }

    /**
     * @throws RandomException
     */
    public function create(CreatePostDto $dto): Model
    {
        return $this->getTableQuery()->create([
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'content' => $dto->body,
            'dummy_post_id' => random_int(1,10),
        ]);
    }
}
