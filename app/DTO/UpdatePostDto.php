<?php

namespace App\DTO;

class UpdatePostDto
{
    public function __construct(
        public readonly int $userId,
        public readonly ?string $title,
        public readonly ?string $body,
    ){}
}
