<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $city = app('App\Models\City');
        $state = app('App\Models\State');
        $dataCNESProxy = app('App\Proxy\DataCNES\DataCNESProxy');
        $responseDataCNES = $dataCNESProxy->fetch('cities');

        collect($responseDataCNES)->each(function ($dataCNESCity, $acronym) use ($state, $city) {
            $state = $state::where('st_acronym', $acronym)->first();

            collect($dataCNESCity)->each(function ($dataCNESCity, $dataCNESId) use ($state, $city) {
                $city::firstOrCreate([
                    'ci_name' => $dataCNESCity,
                    'st_id' => $state->id,
                    'ci_datacnes_id' => $dataCNESId
                ]);
            });
        });

        $this->fillMacroMicroRegions($state, $city);
    }

    private function fillMacroMicroRegions($state, $city)
    {
        $state = $state::where('st_acronym', 'MS')->first();
        $macroCityList = $this->getMacroRegion($state->id, $city);
        $microCityList = $this->getMicroRegion($state->id, $city);

        $mmList = [
            $macroCityList['CAMPO GRANDE'] => [
                $microCityList['CAMPO GRANDE'] => [
                    'BANDEIRANTES',
                    'CAMAPUA',
                    'CAMPO GRANDE',
                    'CHAPADAO DO SUL',
                    'CORGUINHO',
                    'COSTA RICA',
                    'FIGUEIRAO',
                    'JARAGUARI',
                    'MARACAJU',
                    'NOVA ALVORADA DO SUL',
                    'PARAISO DAS AGUAS',
                    'RIBAS DO RIO PARDO',
                    'RIO NEGRO',
                    'ROCHEDO',
                    'SAO GABRIEL DO OESTE',
                    'SIDROLANDIA',
                    'TERENOS'
                ],
                $microCityList['JARDIM'] => [
                    'BELA VISTA',
                    'BONITO',
                    'CARACOL',
                    'GUIA LOPES DA LAGUNA',
                    'JARDIM',
                    'PORTO MURTINHO'
                ],
                $microCityList['COXIM'] => [
                    'ALCINOPOLIS',
                    'COXIM',
                    'PEDRO GOMES',
                    'RIO VERDE DE MATO GROSSO',
                    'SONORA'
                ],
                $microCityList['AQUIDAUANA'] => [
                    'ANASTACIO',
                    'AQUIDAUANA',
                    'BODOQUENA',
                    'DOIS IRMAOS DO BURITI',
                    'MIRANDA',
                    'NIOAQUE'
                ],
            ],
            $macroCityList['CORUMBA'] => [
                $microCityList['CORUMBA'] => [
                    'CORUMBA',
                    'LADARIO'
                ]
            ],
            $macroCityList['DOURADOS'] => [
                $microCityList['DOURADOS'] => [
                    'CAARAPO',
                    'DEODAPOLIS',
                    'DOURADINA',
                    'DOURADOS',
                    'FATIMA DO SUL',
                    'GLORIA DE DOURADOS',
                    'ITAPORA',
                    'JATEI',
                    'LAGUNA CARAPA',
                    'RIO BRILHANTE',
                    'VICENTINA'
                ],
                $microCityList['NAVIRAI'] => [
                    'ELDORADO',
                    'IGUATEMI',
                    'ITAQUIRAI',
                    'JAPORA',
                    'JUTI',
                    'MUNDO NOVO',
                    'NAVIRAI',
                ],
                $microCityList['NOVA ANDRADINA'] => [
                    'ANAURILANDIA',
                    'ANGELICA',
                    'BATAYPORA',
                    'IVINHEMA',
                    'NOVA ANDRADINA',
                    'NOVO HORIZONTE DO SUL',
                    'TAQUARUSSU'
                ],
                $microCityList['PONTA PORA'] => [
                    'AMAMBAI',
                    'ANTONIO JOAO',
                    'ARAL MOREIRA',
                    'CORONEL SAPUCAIA',
                    'PARANHOS',
                    'PONTA PORA',
                    'SETE QUEDAS',
                    'TACURU'
                ]
            ],
            $macroCityList['TRES LAGOAS'] => [
                $microCityList['TRES LAGOAS'] => [
                    'AGUA CLARA',
                    'BATAGUASSU',
                    'BRASILANDIA',
                    'SANTA RITA DO PARDO',
                    'SELVIRIA',
                    'TRES LAGOAS'
                ],
                $microCityList['PARANAIBA'] => [
                    'APARECIDA DO TABOADO',
                    'CASSILANDIA',
                    'INOCENCIA',
                    'PARANAIBA',
                ],
            ]
        ];

        foreach ($mmList as $macroCityId => $microCityList) {
            foreach ($microCityList as $microCityId => $cityList) {
                foreach ($cityList as $relatedCity) {
                    $city::where('st_id', $state->id)->where('ci_name', $relatedCity)->update(['ci_macro_region_id' => $macroCityId, 'ci_micro_region_id' => $microCityId]);
                }
            }
        }
    }

    private function getMacroRegion($stateId, $city)
    {
        $macroCityList = ['CAMPO GRANDE', 'CORUMBA', 'DOURADOS', 'TRES LAGOAS'];

        return $city::where('st_id', $stateId)->whereIn('ci_name', $macroCityList)->get()->flatMap(fn ($city, $key) => [$city->name => $city->id])->all();
    }

    private function getMicroRegion($stateId, $city)
    {
        $microCityList = ['CAMPO GRANDE', 'AQUIDAUANA', 'COXIM', 'JARDIM', 'CORUMBA', 'DOURADOS', 'NAVIRAI', 'NOVA ANDRADINA', 'PONTA PORA', 'PARANAIBA', 'TRES LAGOAS'];

        return $city::where('st_id', $stateId)->whereIn('ci_name', $microCityList)->get()->flatMap(fn ($city, $key) => [$city->name => $city->id])->all();
    }
}
