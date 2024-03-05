<?php

namespace App\Http\Requests\Post;

use App\DTO\CreatePostDto;
use App\DTO\UpdatePostDto;
use App\Http\Requests\CommonRequest;
use Illuminate\Support\Arr;

class PostUpdateRequest extends CommonRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
        ];
    }

    public function getDto(): UpdatePostDto
    {
        $payload = $this->validated();
        $userId = auth()->user()->id;

        return new UpdatePostDto(
            userId: $userId,
            title: Arr::get($payload, 'title'),
            body: Arr::get($payload, 'body')
        );
    }
}
