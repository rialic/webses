<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*----------------------------------------------------------------*\
          ADMIN
        \*----------------------------------------------------------------*/
        Permission::firstOrCreate(['pe_name' => 'ADMIN']);

        /*----------------------------------------------------------------*\
          HOME
        \*----------------------------------------------------------------*/
        Permission::firstOrCreate(['pe_name' => 'MAIN']);
        Permission::firstOrCreate(['pe_name' => 'HOME']);

        /*----------------------------------------------------------------*\
        WEB
        \*----------------------------------------------------------------*/

        Permission::firstOrCreate(['pe_name' => 'WEB.MENU']);

        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--VIEW']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--CREATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--EDIT']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--UPDATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--DELETE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.EVENT--CERTIFICATE']);

        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--VIEW']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--CREATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--EDIT']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--UPDATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--DELETE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.COURSE--CERTIFICATE']);
    }
}
