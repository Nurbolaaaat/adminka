<?php

namespace App\Services;

use App\DTO\CreatePostDto;
use App\DTO\UpdatePostDto;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Random\RandomException;

class PostService
{
    const CACHE_KEY = 'post_';

    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @throws RandomException
     */
    public function create(CreatePostDto $dto): Model
    {
        return $this->postRepository->create($dto);
    }

    public function update(UpdatePostDto $dto, Model $post, DummyJsonService $service): void
    {
        $dataToUpdate = [];

        if ($dto?->body !== null) {
            $dataToUpdate['body'] = $dto->body;
        }

        if ($dto?->title !== null) {
            $dataToUpdate['title'] = $dto->title;
        }

        $this->removeCachedPostData($post->dummy_post_id);

        $service->update($dataToUpdate, $post->dummy_post_id);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        $localPaginatedPosts = $this->postRepository->getPaginated();
        $localPaginatedPostIdsArr = $localPaginatedPosts->pluck('dummy_post_id')->toArray();
        $dummyJsonPostData = $this->getDummyJsonDataByIds($localPaginatedPostIdsArr);

        return $this->mappingLocalAndDummyJsonApiData($localPaginatedPosts, $dummyJsonPostData);
    }

    private function getDummyJsonDataByIds(array $dummyJsonIds): array
    {
        $result = [];
        $cacheTtlValue = 10;

        foreach ($dummyJsonIds as $id) {
            $cachedData = Cache::get(self::CACHE_KEY . $id);

            if (!$cachedData && $id != null) {
                $dummyPostData = $this->getPostDataFromDummyJsonApi($id);

                Cache::put(self::CACHE_KEY . $id, $dummyPostData, now()->addMinutes($cacheTtlValue));
            } else {
                $dummyPostData = $cachedData;
            }

            $result[$id] = $dummyPostData;
        }

        return $result;
    }

    private function getPostDataFromDummyJsonApi(int $id): array
    {
        $dummyJsonService = new DummyJsonService();

        return $dummyJsonService->getPostDataById($id);
    }

    private function mappingLocalAndDummyJsonApiData($local, array $dummyJson): LengthAwarePaginator
    {
        foreach ($local as &$value) {
            $dummyJsonId = $value['dummy_post_id'];

            $value['title'] = Arr::get($dummyJson, $dummyJsonId . '.title');
            $value['body'] = Arr::get($dummyJson, $dummyJsonId . '.body');
        }

        return $local;
    }

    public function getPostById(Model $post): array
    {
        $dummyData = $this->getPostDataFromDummyJsonApi($post->dummy_post_id);

        return [
            'id' => $post->id,
            'user' => [
                'id' => $post->user->id,
                'name' => $post->user->name,
            ],
            'title' => $dummyData['title'],
            'body' => $dummyData['body'],
        ];
    }

    private function removeCachedPostData(int $dummyPostId): void
    {
        Cache::forget(self::CACHE_KEY . $dummyPostId);
    }
}
