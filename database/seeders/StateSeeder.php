<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $state = app('App\Models\State');

        $state::firstOrCreate([
            'st_name' => 'ACRE',
            'st_acronym' => 'AC'
        ]);

        $state::firstOrCreate([
            'st_name' => 'ALAGOAS',
            'st_acronym' => 'AL'
        ]);

        $state::firstOrCreate([
            'st_name' => 'AMAZONAS',
            'st_acronym' => 'AM'
        ]);

        $state::firstOrCreate([
            'st_name' => 'AMAPA',
            'st_acronym' => 'AP'
        ]);

        $state::firstOrCreate([
            'st_name' => 'BAHIA',
            'st_acronym' => 'BA'
        ]);

        $state::firstOrCreate([
            'st_name' => 'CEARA',
            'st_acronym' => 'CE'
        ]);

        $state::firstOrCreate([
            'st_name' => 'DISTRITO FEDERAL',
            'st_acronym' => 'DF'
        ]);

        $state::firstOrCreate([
            'st_name' => 'ESPIRITO SANTO',
            'st_acronym' => 'ES'
        ]);

        $state::firstOrCreate([
            'st_name' => 'GOIAS',
            'st_acronym' => 'GO'
        ]);

        $state::firstOrCreate([
            'st_name' => 'MARANHAO',
            'st_acronym' => 'MA'
        ]);

        $state::firstOrCreate([
            'st_name' => 'MINAS GERAIS',
            'st_acronym' => 'MG'
        ]);

        $state::firstOrCreate([
            'st_name' => 'MATO GROSSO DO SUL',
            'st_acronym' => 'MS'
        ]);

        $state::firstOrCreate([
            'st_name' => 'MATO GROSSO',
            'st_acronym' => 'MT'
        ]);

        $state::firstOrCreate([
            'st_name' => 'PARA',
            'st_acronym' => 'PA'
        ]);

        $state::firstOrCreate([
            'st_name' => 'PARAIBA',
            'st_acronym' => 'PB'
        ]);

        $state::firstOrCreate([
            'st_name' => 'PERNAMBUCO',
            'st_acronym' => 'PE'
        ]);

        $state::firstOrCreate([
            'st_name' => 'PIAUI',
            'st_acronym' => 'PI'
        ]);

        $state::firstOrCreate([
            'st_name' => 'PARANA',
            'st_acronym' => 'PR'
        ]);

        $state::firstOrCreate([
            'st_name' => 'RIO DE JANEIRO',
            'st_acronym' => 'RJ'
        ]);

        $state::firstOrCreate([
            'st_name' => 'RIO GRANDE DO NORTE',
            'st_acronym' => 'RN'
        ]);

        $state::firstOrCreate([
            'st_name' => 'RONDONIA',
            'st_acronym' => 'RO'
        ]);

        $state::firstOrCreate([
            'st_name' => 'RORAIMA',
            'st_acronym' => 'RR'
        ]);

        $state::firstOrCreate([
            'st_name' => 'RIO GRANDE DO SUL',
            'st_acronym' => 'RS'
        ]);

        $state::firstOrCreate([
            'st_name' => 'SANTA CATARINA',
            'st_acronym' => 'SC'
        ]);

        $state::firstOrCreate([
            'st_name' => 'SERGIPE',
            'st_acronym' => 'SE'
        ]);

        $state::firstOrCreate([
            'st_name' => 'SAO PAULO',
            'st_acronym' => 'SP'
        ]);

        $state::firstOrCreate([
            'st_name' => 'TOCANTINS',
            'st_acronym' => 'TO'
        ]);
    }
}
