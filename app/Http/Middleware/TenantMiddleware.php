<?php

namespace App\Http\Middleware;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $managerTenant = app(ManagerTenant::class);
        // $tenant = $managerTenant->tenant();

        // if (!$tenant) {
        //     // TODO => CORRIGIR MIDDLEWARE PARA FAZER UM RETORNO MAIS AMIGÁVEL DO ERRO
        //     return abort(500);
        // }

        // Log::info(['Here => ' => "{$request->method()} <=> {$request->path()}"]);

        return $next($request);
    }
}
