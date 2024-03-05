<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'id' => 1,
                'name' => 'Пользователь 1',
                'email' => 'user1@user.com',
                'password' => Hash::make('Admin123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Пользователь 2',
                'email' => 'user2@user.com',
                'password' => Hash::make('Admin123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Пользователь 3',
                'email' => 'user3@user.com',
                'password' => Hash::make('Admin123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($items as $item) {
            User::query()
                ->updateOrCreate(['id' => $item['id']], $item);
        }

        User::query()
            ->selectRaw("setval(pg_get_serial_sequence('users', 'id'), max(id))")
            ->get();
    }
}
