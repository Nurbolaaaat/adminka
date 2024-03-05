<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function register(UserDto $userDto, UserRepository $userRepository): Model
    {
        return $userRepository->create($userDto);
    }
}
