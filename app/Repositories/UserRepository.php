<?php

namespace App\Repositories;

use App\DTO\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function create(UserDto $userDto): Model
    {
        return User::query()->create([
            'email' => $userDto->email,
            'password' => $userDto->password,
            'name' => $userDto->name,
        ]);
    }
}
