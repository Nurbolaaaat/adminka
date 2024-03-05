<?php

namespace App\Http\Requests\Post;

use App\DTO\CreatePostDto;
use App\Http\Requests\CommonRequest;

class PostCreateRequest extends CommonRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ];
    }

    public function getDto(): CreatePostDto
    {
        $payload = $this->validated();
        $userId = auth()->user()->id;

        return new CreatePostDto(
            userId: $userId,
            title: $payload['title'],
            body: $payload['body'],
        );
    }
}
