<?php

namespace App\Observers\Global;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class GlobalObserver
{
    public function creating(Model $model)
    {
        // $tenant = app(ManagerTenant::class)->tenant();
        // $model->setAttribute('tenant_id', $tenant->id);
    }
}
