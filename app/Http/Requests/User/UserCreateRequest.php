<?php

namespace App\Http\Requests\User;

use App\DTO\UserDto;
use App\Http\Requests\CommonRequest;

class UserCreateRequest extends CommonRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z-w-яңәіқұүғөһё\s.\-]*$/'],
            'password' => ['required', 'min:8']
        ];
    }

    public function getDto(): UserDto
    {
        $payload = $this->validated();

        return new UserDto(
            email: $payload['email'],
            password: $payload['password'],
            name: $payload['name'],
        );
    }
}
