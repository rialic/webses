<?php

namespace App\Http\Resources\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;

class VerifyEmailResource implements VerifyEmailResponseContract
{
    public function toResponse($request)
    {
        $subdomain = lcfirst($request->user()->current_subdomain);
        $subdomainList = collect(explode(',', env('SANCTUM_STATEFUL_DOMAINS')));
        $url = $subdomainList->first(function ($subdomainItem) use ($subdomain) {
            return Str::contains($subdomainItem, $subdomain);
        });

        return redirect("https://{$url}/home");
    }
}
