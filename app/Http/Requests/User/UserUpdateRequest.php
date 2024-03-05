<?php

namespace App\Http\Requests\User;


use App\Http\Requests\CommonRequest;

class UserUpdateRequest extends CommonRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z-w-яңәіқұүғөһё\s.\-]*$/'],
            'city' => ['required', 'string'],
            'delivery_address' => ['required', 'string'],
            'company_name' => ['required','string'],
            'delivery_type' => ['required', 'string'],
        ];
    }
}
