<?php

namespace Database\Seeders;

use App\Models\Submodule;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class SubmoduleSeeder extends Seeder
{
    const MASTER = 'master';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantList = Tenant::with('modules')->get();

        /*----------------------------------------------------------------*\
          SUBMODULE FOR ALL TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function($tenant, $key) {
            $tenant->modules->each(function($module, $key) {
                if ($module->name === 'Configurações') {
                    Submodule::firstOrCreate(['sub_name' => 'Usuários', 'mo_id' => $module->id]);
                    Submodule::firstOrCreate(['sub_name' => 'Papéis', 'mo_id' => $module->id]);
                    Submodule::firstOrCreate(['sub_name' => 'Permissões', 'mo_id' => $module->id]);
                }
            });
        });

        /*----------------------------------------------------------------*\
          SUBMODULE FOR SPECIFIC TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function($tenant, $key) {
            $tenant->modules->each(function($module, $key) use($tenant) {
                // MASTER TENANT
                if($tenant->subdomain === self::MASTER) {
                    // WEB ONLINE MODULE
                    if ($module->name === 'Web Online') {
                        Submodule::firstOrCreate(['sub_name' => 'Web Aulas', 'mo_id' => $module->id]);
                        Submodule::firstOrCreate(['sub_name' => 'Cursos', 'mo_id' => $module->id]);
                    }
                }
            });
        });
    }
}
