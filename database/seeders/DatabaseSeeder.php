<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TenantSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(EstablishmentSeeder::class);
        $this->call(CBOSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(TenantModuleSeeder::class);
        $this->call(SubmoduleSeederSeeder::class);
    }
}