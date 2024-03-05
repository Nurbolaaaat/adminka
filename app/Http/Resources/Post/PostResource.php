<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->resource->title,
            'body' => $this->resource->body,
            'dummy_post_id' => $this->resource->dummy_post_id,
        ];
    }
}
