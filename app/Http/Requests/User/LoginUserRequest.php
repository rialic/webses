<?php

namespace App\Http\Requests\User;

use Laravel\Fortify\Http\Requests\LoginRequest;

class LoginUserRequest extends LoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo email, cpf é obrigatório.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'remember_me' => ['boolean'],
            'password' => ['required', 'max:35'],
            'device_name' => ['required', 'string', 'max:200']
        ];
    }
}
