<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*----------------------------------------------------------------*\
          ADMIN
        \*----------------------------------------------------------------*/
        Role::firstOrCreate(['ro_name' => 'ADMIN']);

        /*----------------------------------------------------------------*\
          USER
        \*----------------------------------------------------------------*/
        Role::firstOrCreate(['ro_name' => 'USER']);
    }
}
