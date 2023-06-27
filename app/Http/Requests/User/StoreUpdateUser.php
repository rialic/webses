<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUser extends FormRequest
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
            'name.regex' => 'Por favor informe o seu Nome Completo (Apenas Letras).',
            'cpf.unique' => 'CPF já está cadastrado no sistema.',
            'email.unique' => 'Email já está cadastrado no sistema.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $uuid = $this->user;

        $rules = [
            'name' => ['required', 'string', "regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+\040[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð\040,.'-]+$/", 'max:100'],
            'cpf' => ['required', 'cpf', 'max:11', "unique:tb_user,us_cpf,{$uuid},us_uuid"],
            'email' => ['required', 'email', 'max:255', "unique:tb_user,us_email,{$uuid},us_uuid"],
            'password' => ['required', 'min:6', 'max:8'],
            'device_name' => ['required', 'string', 'max:200']
        ];

        if ($this->method() === 'PUT') {
            $rules['password'] = ['nullable', 'min:6', 'max:8'];
        }

        return $rules;
    }
}
