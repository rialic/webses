<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    const MASTER = 'master';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantList = Tenant::all();

        /*----------------------------------------------------------------*\
          ROLE FOR ALL TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function ($tenant, $key) {
            /*----------------------------------------------------------------*\
              ADMIN
            \*----------------------------------------------------------------*/
            $rolePermission = $this->hasRolePermission('ADMIN', 'ADMIN', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            /*----------------------------------------------------------------*\
              USER
            \*----------------------------------------------------------------*/
            $rolePermission = $this->hasRolePermission('USER', 'MAIN', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            $rolePermission = $this->hasRolePermission('USER', 'HOME', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            $rolePermission = $this->hasRolePermission('USER', 'WEB.MENU', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            $rolePermission = $this->hasRolePermission('USER', 'WEB.EVENT', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            $rolePermission = $this->hasRolePermission('USER', 'WEB.EVENT--VIEW', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);

            $rolePermission = $this->hasRolePermission('USER', 'WEB.EVENT--CERTIFICATE', $tenant->name);
            $this->createRolePermission($rolePermission, $tenant->id);
        });

        /*----------------------------------------------------------------*\
          ROLE FOR SPECIFIC TENANTS
        \*----------------------------------------------------------------*/
        $tenantList->each(function ($tenant, $key) {
            /*----------------------------------------------------------------*\
              USER
            \*----------------------------------------------------------------*/
            // MASTER TENANT
            if ($tenant->subdomain === self::MASTER) {
                $rolePermission = $this->hasRolePermission('USER', 'WEB.COURSE', $tenant->name);
                $this->createRolePermission($rolePermission, $tenant->id);

                $rolePermission = $this->hasRolePermission('USER', 'WEB.COURSE--VIEW', $tenant->name);
                $this->createRolePermission($rolePermission, $tenant->id);

                $rolePermission = $this->hasRolePermission('USER', 'WEB.COURSE--CERTIFICATE', $tenant->name);
                $this->createRolePermission($rolePermission, $tenant->id);
            }
        });
    }

    private function hasRolePermission($role, $permission, $tenant)
    {
        $tenantId = Tenant::where('tenant_name', $tenant)->value('tenant_id');
        $roleId = Role::where('ro_name', $role)->value('ro_id');
        $permissionId = Permission::where('pe_name', $permission)->value('pe_id');

        $tenantQuery = Tenant::select('tenant_id')->where('tenant_name', $tenant);
        $roleQuery = Role::select('ro_id')->where('ro_name', $role);
        $permissionQuery = Permission::select('pe_id')->where('pe_name', $permission);

        $count = RolePermission::joinSub($roleQuery, 'role', function ($join) {
            $join->on('tb_role_permissions.ro_id', '=', 'role.ro_id');
        })->joinSub($permissionQuery, 'permission', function ($join) {
            $join->on('tb_role_permissions.pe_id', '=', 'permission.pe_id');
        })->joinSub($tenantQuery, 'tenant', function ($join) {
            $join->on('tb_role_permissions.tenant_id', '=', 'tenant.tenant_id');
        })->count();

        return array('register' => ($count > 0), 'role' => $roleId, 'permission' => $permissionId, 'tenant' => $tenantId);
    }

    private function createRolePermission($rolePermission)
    {
        if ($rolePermission['register'] === false) {
            RolePermission::create(['ro_id' => $rolePermission['role'], 'pe_id' => $rolePermission['permission'], 'tenant_id' => $rolePermission['tenant']]);
        }
    }
}
