<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // TODO COLOCAR VALIDATION E CREATION NO ARQUIVO FORTIFYSERVICEPROVIDER
        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255', "regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+\040[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð\040,.'-]+$/"],
                'cpf' => ['required', 'cpf', 'max:11', "unique:tb_users,us_cpf"],
                'sex' => ['required', Rule::in(['m', 'f'])],
                'email' => ['required', 'string', 'email', 'max:255', "unique:tb_users,us_email"],
                'state' => ['required', 'exists:tb_states,st_uuid'],
                'city' => ['required', 'exists:tb_cities,ci_uuid'],
                'cbo' => ['required', 'exists:tb_cbo,cbo_uuid'],
                'establishment' => ['required', 'exists:tb_establishments,es_uuid'],
                'password' => $this->passwordRules(),
                'confirm_password' => ['same:password'],
                'device_name' => ['required', 'string', 'max:200']
            ],
            [
                'password' => 'Senha deve ter pelo menos 8 caracteres e conter pelo menos 1 número.',
                'cpf.unique' => 'CPF já está em uso no sistema.',
                'email.unique' => 'Email já está em uso no sistema'
            ]
        )->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
