<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CBOSeeder extends Seeder
{
    public function run(): void
    {
        $cbo = app('App\Models\CBO');
        $dataCNESProxy = app('App\Proxy\DataCNES\DataCNESProxy');
        $responseDataCNES = $dataCNESProxy->fetch('cbo');

        collect($responseDataCNES)->each(function($dataCNESCBO, $cboCode) use ($cbo){
            $cbo::firstOrCreate([
                'cbo_code' => $cboCode,
                'cbo_name' => $dataCNESCBO['name']
            ]);
        });
    }
}
