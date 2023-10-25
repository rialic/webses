<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Proxy\DataCNES\DataCNESProxy;
use Illuminate\Support\Str;

class UserCnesController extends Controller
{
    public function index()
    {
        $params = null;
        $arguments = request()->all();
        foreach ($arguments as $field => $value) {
            if (Str::startsWith($field, 'filter:')) {
              $params[$field] = $value;
            }
        }

        $dataCNESProxy = app(DataCNESProxy::class);
        $responseDataCNES = $dataCNESProxy->fetch('user', $params['filter:cpf']);


        if ($responseDataCNES) {
            $user = $responseDataCNES[0] ?? $responseDataCNES;

            return response()->json(['data' => ['user' => $user]]);
        }

        return response()->json(['data' => null], 200);
    }
}
