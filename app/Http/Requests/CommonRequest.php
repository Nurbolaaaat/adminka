<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommonRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'required' => ':attribute должно быть заполнено.',
            'string' => ':attribute является строкой.',
            'email' => 'Адрес электронной почты не действительный.',
            'max' => ':attribute не может содержать больше :max символов',
            'unique' => ':attribute уже занята!',
            'min' => ':attribute должен содержать не менее :min символов.',
            'regex' => ':attribute должен состоять из восьми или более символов латинского алфавита, содержать заглавные и строчные буквы, цифры',
            'confirmed' => ':attribute не совпадает.',
            'exists' => ':attribute не подходит'
        ];
    }
}
