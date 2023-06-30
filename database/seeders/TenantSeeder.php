<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = app(Tenant::class);

        $tenant::create([
            'tenant_subdomain' => 'tsms',
            'tenant_name' => 'Telessaúde MS'
        ]);
    }
}
