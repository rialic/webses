<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = app('App\Models\User');

        $user::firstOrCreate([
            'us_name' => 'Rhiali Cândido',
            'us_email' => 'rhiali_cs@hotmail.com',
            'us_cpf' => '01052835171',
            'us_cns' => '123456790',
            'us_verified_at' => null,
            'us_status' => true,
            'us_password' => '1'
        ]);
    }
}
