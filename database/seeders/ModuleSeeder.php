<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::firstOrCreate(['mo_name' => 'Dashboard']);
        Module::firstOrCreate(['mo_name' => 'Web Online']);
        Module::firstOrCreate(['mo_name' => 'Teleconsultoria']);
        Module::firstOrCreate(['mo_name' => 'Configurações']);
    }
}
