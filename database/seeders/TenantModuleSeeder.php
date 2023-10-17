<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Tenant;
use App\Models\TenantModule;
use Illuminate\Database\Seeder;

class TenantModuleSeeder extends Seeder
{
    const MASTER = 'master';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantList = Tenant::all();

        /*----------------------------------------------------------------*\
          MODULE FOR ALL TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function ($tenant, $key) {
            $rolePermission = $this->hasTenantModule($tenant->name, 'Dashboard');
            $this->createTenantModule($rolePermission, $tenant->id);

            $rolePermission = $this->hasTenantModule($tenant->name, 'Configurações');
            $this->createTenantModule($rolePermission, $tenant->id);
        });


        /*----------------------------------------------------------------*\
          MODULE FOR SPECIFIC TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function ($tenant, $key) {
            // MASTER TENANT
            if ($tenant->subdomain === self::MASTER) {
                $rolePermission = $this->hasTenantModule($tenant->name, 'Web Online');
                $this->createTenantModule($rolePermission, $tenant->id);

                $rolePermission = $this->hasTenantModule($tenant->name, 'Teleconsultoria');
                $this->createTenantModule($rolePermission, $tenant->id);
            }
        });
    }

    private function hasTenantModule($tenant, $module)
    {
        $tenantId = Tenant::where('tenant_name', $tenant)->value('tenant_id');
        $moduleId = Module::where('mo_name', $module)->value('mo_id');

        $tenantQuery = Tenant::select('tenant_id')->where('tenant_name', $tenant);
        $moduleQuery = Module::select('mo_id')->where('mo_name', $module);

        $count = TenantModule::joinSub($moduleQuery, 'module', function ($join) {
            $join->on('tb_tenant_modules.mo_id', '=', 'module.mo_id');
        })->joinSub($tenantQuery, 'tenant', function ($join) {
            $join->on('tb_tenant_modules.tenant_id', '=', 'tenant.tenant_id');
        })->count();

        return array('register' => ($count > 0), 'module' => $moduleId, 'tenant' => $tenantId);
    }

    private function createTenantModule($tenantModule)
    {
        if ($tenantModule['register'] === false) {
            TenantModule::create(['mo_id' => $tenantModule['module'], 'tenant_id' => $tenantModule['tenant']]);
        }
    }
}
