<?php

namespace App\Proxy\DataCNES;

use Illuminate\Support\Facades\Http;
use App\Proxy\DataCNES\DataCNESHeaders;

class DataCNESProxy
{
  private $dataCNESHeaders;

  public function __construct(DataCNESHeaders $dataCNESHeaders)
  {
    $this->dataCNESHeaders = $dataCNESHeaders;
  }

  public function fetch(string $typeObject, string $data = null)
  {
    $fetchList = [
      'cities' => fn () => $this->fetchCities(),
      'establishments' => fn () => $this->fetchEstablishments(),
      'cbo' => fn () => $this->fetchCBO(),
      'user' => fn () => $this->fetchUser($data)
    ];

    return call_user_func($fetchList[$typeObject]);
  }

  private function fetchCities()
  {
    $response = Http::withHeaders($this->dataCNESHeaders->getEstablishmentHeader())->get('https://cnes.datasus.gov.br/services/estados');

    if ($response->ok()) {
      $state = app('App\Models\State');
      $stateList = $state::all();
      $cityList = [];
      $dataCNESStateList = $response->json();

      foreach ($dataCNESStateList as $key => $state) {

        $response = Http::withHeaders($this->dataCNESHeaders->getEstablishmentHeader())->get("https://cnes.datasus.gov.br/services/municipios?estado={$key}");

        if ($response->ok()) {
          $acronym = $stateList->first(function ($state) use ($dataCNESStateList, $key) {
            return $state->name === $dataCNESStateList[$key];
          })->acronym;

          $cityList[$acronym] = $response->json();

          continue;
        }

        $response->throw()->json();
      }

      return $cityList;
    }
  }

  private function fetchEstablishments()
  {
    $city = app('App\Models\City');
    $cityList = $city::all();
    $establishmentList = [];

    ini_set('memory_limit', '-1');

    foreach ($cityList as $key => $city) {
      $response = Http::withHeaders($this->dataCNESHeaders->getEstablishmentHeader())->retry(3, 15000)->get("https://cnes.datasus.gov.br/services/estabelecimentos?municipio={$city->datacnes_id}");

      if ($response->ok()) {
        $dataCNESEstablishmentList = $response->json();

        $establishmentList += collect($dataCNESEstablishmentList)->reduce(function($acc, $establishment) use($city) {
          $acc[$establishment['id']] = [
            'cnes' => $establishment['cnes'],
            'name' => $establishment['noFantasia'],
            'management' => $establishment['gestao'],
            'legal_nature' => $establishment['natJuridica'],
            'sus' => $establishment['atendeSus'],
            'ci_id' => $city->id
          ];

          return $acc;
        }, []);

        $establishmentList[$city->datacnes_id] = [
          'cnes' => '9999999',
          'name' => 'OUTROS',
          'management' => 'E',
          'legal_nature' => 1,
          'sus' => 'S',
          'ci_id' => $city->id
        ];

        continue;
      }

      $response->throw()->json();
    }

    return $establishmentList;
  }

  private function fetchCBO()
  {
    $response = Http::withHeaders($this->dataCNESHeaders->getCBOHeader())->get('https://sistemas.unasus.gov.br/ws_cbo/cbo.php?words=%%%');

    if ($response->ok()) {
      $cboList = [];
      $cboXML = simplexml_load_string($response->body());

      foreach($cboXML->children() as $cboXMLELement) {
        if (!str_contains($cboXMLELement->cbo, 'X')) {
          $cboList[((string) $cboXMLELement->cbo)] = [
            'name' => (string) $cboXMLELement->descricao
          ];
        }
      }

      return $cboList;
    }

    $response->throw()->json();
  }

  private function fetchUser($data)
  {
    $response = Http::withHeaders($this->dataCNESHeaders->getProfessionalsHeader())->get("https://cnes.datasus.gov.br/services/profissionais?cpf={$data}");

    if ($response->ok()) {
      $user = $response->json()[0];
      $response = Http::withHeaders($this->dataCNESHeaders->getProfessionalsHeader())->get("https://cnes.datasus.gov.br/services/profissionais/{$user['id']}");

      if ($response->ok()) {
        return $response->json();
      }

      return [$user];
    }

    return null;
  }
}
