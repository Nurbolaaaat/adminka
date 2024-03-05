<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class PostCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn ($item) => new PostResource($item))->toArray();
    }
}
