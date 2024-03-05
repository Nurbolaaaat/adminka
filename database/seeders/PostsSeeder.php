<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'id' => 1,
                'user_id' => 1,
                'dummy_post_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'dummy_post_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'dummy_post_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($items as $item) {
            Post::query()
                ->updateOrCreate(['id' => $item['id']], $item);
        }

        Post::query()
            ->selectRaw("setval(pg_get_serial_sequence('posts', 'id'), max(id))")
            ->get();
    }
}
