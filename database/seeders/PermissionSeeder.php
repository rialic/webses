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
        Permission::firstOrCreate(['pe_name' => 'HOME']);

        /*----------------------------------------------------------------*\
          WEB
        \*----------------------------------------------------------------*/
        Permission::firstOrCreate(['pe_name' => 'WEB.MENU']);

        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--VIEW']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--CREATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--EDIT']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--UPDATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--DELETE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.MEETING--CERTIFICATE']);

        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--VIEW']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--CREATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--EDIT']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--UPDATE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--DELETE']);
        Permission::firstOrCreate(['pe_name' => 'WEB.CLASS--CERTIFICATE']);
    }
}
