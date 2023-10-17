<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*----------------------------------------------------------------*\
          SEED FOR SPECIFC TENANTS AND FOR ALL TENANTS
        \*----------------------------------------------------------------*/
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(TenantModuleSeeder::class);
        $this->call(SubmoduleSeeder::class);
    }
}
