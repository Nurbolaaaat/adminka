<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\CommonRequest;

class LoginRequest extends CommonRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string'],
            'password' => ['required', 'min:8']
        ];
    }
}
