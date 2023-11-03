<?php

namespace App\Observers\Global;

use Illuminate\Database\Eloquent\Model;

class GlobalObserver
{
    public function creating(Model $model)
    {
        $tenant = app('App\Tenant\ManagerTenant')->tenant();
        $model->setAttribute('tenant_id', $tenant->id);
    }
}
