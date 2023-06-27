<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

class UserCnesController extends Controller
{
    private $filterFields = [
        'cpf'
    ];

    public function index()
    {
        $arguments = $this->getFilterFields();
        $dataCNESProxy = app('App\Proxy\DataCNES\DataCNESProxy');
        $responseDataCNES = $dataCNESProxy->fetch('user', $arguments['filter:cpf']);

        if ($responseDataCNES) {
            $user = $responseDataCNES[0];

            return response()->json(['data' => ['user' => $user], 'status' => 200]);
        }

        return response()->json(null);
    }

    private function getFilterFields() :array
    {
        $filterFields = [];

        foreach (request()->all() as $key => $value) {
            $isFilterFieldSettedUp = str_starts_with($key, 'filter:');
            $isFilterFieldInArray = in_array(substr($key, strpos($key, ':') + 1 ), $this->filterFields);

            if ($isFilterFieldSettedUp && $isFilterFieldInArray) {
                $filterFields[$key] = $value;
            }
        }

        return $filterFields;
    }
}
