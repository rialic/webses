<?php

namespace App\Http\Middleware;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;
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
        $managerTenant = app(ManagerTenant::class);
        $tenant = $managerTenant->tenant();

        if (!$tenant) {
            abort(500);
        }

        return $next($request);
    }
}
