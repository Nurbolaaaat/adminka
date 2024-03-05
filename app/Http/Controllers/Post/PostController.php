<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\Post\PostCollection;
use App\Models\Post\Post;
use App\Services\DummyJsonService;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $postService)
    {
        $this->service = $postService;
    }

    public function index(): PostCollection
    {
        return new PostCollection($this->service->getPaginated());
    }

    /**
     * @throws RandomException
     */
    public function store(PostCreateRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->service->create($dto);

        return response()->json(['message' => 'Post created successfully']);
    }

    public function delete(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function update(PostUpdateRequest $request, Post $post, DummyJsonService $service): JsonResponse
    {
        $dto = $request->getDto();

        $this->service->update($dto, $post, $service);

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($this->service->getPostById($post->load(['user'])));
    }
}
