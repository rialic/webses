<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repository\Interfaces\RoleInterface as RoleRepository;
use App\Repository\Interfaces\EstablishmentInterface as EstablishmentRepository;
use App\Repository\Interfaces\CBOInterface as CBORepository;

class UserSeeder extends Seeder
{
    private $roleRepository;
    private $establishmentRepository;
    private $cboRepository;

    public function __construct(RoleRepository $roleRepository, EstablishmentRepository $establishmentRepository, CBORepository $cboRepository) {
        $this->roleRepository = $roleRepository;
        $this->establishmentRepository = $establishmentRepository;
        $this->cboRepository  = $cboRepository;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = app('App\Models\Tenant');
        $user = app('App\Models\User');
        $isLocalEnv = app('env');

        if ($isLocalEnv) {
            $user = $user::firstOrCreate([
                'us_name' => 'Admin',
                'us_email' => 'admin@admin.com',
                'us_cpf' => '00000000000',
                'us_cns' => '123456790',
                'us_verified_at' => date('y-m-d H:i:s'),
                'us_status' => true,
                'us_password' => bcrypt(1),
                'us_current_subdomain' => $tenant::first()->name
            ]);

            $role = $this->roleRepository->getFirstData(parseFilters(['name' => 'ADMIN']));
            $establishment = $this->establishmentRepository->getModel()::inRandomOrder()->first();
            $cbo = $this->cboRepository->getModel()::inRandomOrder()->first();

            $user->establishments()->sync([$establishment->id => ['eu_primary_bond' => true, 'cbo_id' => $cbo->id]]);
            $tenant::all()->each(function($tenant) use($user, $role) {
                $user->tenants()->sync($tenant->id);
                $user->roles()->sync([$role->id => ['tenant_id' => $tenant->id]]);
            });
        }

    }
}
