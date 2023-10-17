<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\HasResourceController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResentEmailVerificationController extends Controller
{
    use HasResourceController;

    public function resentEmailVerification(Request $request)
    {

        if (!$request->user()) {
            // TODO SE NÃO EXISTE USUÁRIO LOGADO OU ATIVO NA SESSION ENTÃO DESLOGAR O USUÁRIO
        }

        if ($request->user()->hasVerifiedEmail()) {
            $subdomain = lcfirst($request->user()->current_subdomain);
            $subdomainList = collect(explode(',', env('SANCTUM_STATEFUL_DOMAINS')));
            $url = $subdomainList->first(function ($subdomainItem) use ($subdomain) {
                return Str::contains($subdomainItem, $subdomain);
            });

            return redirect("https://{$url}/home");
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email reenviado com sucesso.']);
    }
}
