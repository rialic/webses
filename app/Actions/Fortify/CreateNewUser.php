<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Repository\Interfaces\RoleInterface as RoleRepository;
use App\Repository\Interfaces\EstablishmentInterface as EstablishmentRepository;
use App\Repository\Interfaces\CBOInterface as CBORepository;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    private $user;
    private $roleRepository;
    private $establishmentRepository;
    private $cboRepository;

    public function __construct(User $user, RoleRepository $roleRepository, EstablishmentRepository $establishmentRepository, CBORepository $cboRepository) {
        $this->user = $user;
        $this->roleRepository = $roleRepository;
        $this->establishmentRepository = $establishmentRepository;
        $this->cboRepository  = $cboRepository;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $managerTenant = app('App\Tenant\ManagerTenant');
        $tenant = $managerTenant->tenant();

        abort_if(!$tenant, 400);

        $data['name'] = $input['name'];
        $data['cpf'] = $input['cpf'];
        $data['sex'] = $input['sex'];
        $data['sex'] = $input['sex'];
        $data['email'] = $input['email'];
        $data['state'] = $input['state'];
        $data['city'] = $input['city'];
        $data['cbo'] = $input['cbo'];
        $data['establishment'] = $input['establishment'];
        $data['password'] = $input['password'];
        $data['password_confirmation'] = $input['password_confirmation'];
        $data['device_name'] = $input['device_name'];

        Validator::make(
            $data,
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
                'password_confirmation' => ['same:password'],
                'device_name' => ['required', 'string', 'max:200']
            ],
            [
                'password' => 'Senha deve ter pelo menos 8 caracteres.',
                'cpf.unique' => 'CPF já está em uso no sistema.',
                'email.unique' => 'Email já está em uso no sistema'
            ]
        )->validate();

        $role = $this->roleRepository->getFirstData(parseFilters(['name' => 'USER']));
        $establishment = $this->establishmentRepository->findByUuid($data['establishment']);
        $cbo = $this->cboRepository->findByUuid($data['cbo']);

        $this->user->fill($this->user->syncFields([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'sex' => ($data['sex'] === 'm') ? 'Masculino' : 'Feminino',
            'password' => $input['password'],
            'current_subdomain' => $tenant->name
        ]));

        $this->user->save();
        $this->user->establishments()->sync([$establishment->id => ['eu_primary_bond' => true, 'cbo_id' => $cbo->id]]);
        $this->user->tenants()->sync($tenant->id);
        $this->user->roles()->sync([$role->id => ['tenant_id' => $tenant->id]]);

        return $this->user;
    }
}
