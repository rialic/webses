<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
  public function subdomain()
  {
    $hostFragments = explode('.', optional(optional(request()->header())['domain'])[0]);

    if (isset($hostFragments[0]) && !empty($hostFragments[0])) return $hostFragments[0];
  }

  public function tenant()
  {
    $subdomain = $this->subdomain();

    return Tenant::where('tenant_subdomain', $subdomain)->first();
  }
}