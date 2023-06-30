<?php

namespace App\Models\Scopes;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $query, Model $model): void
    {
        $tenant = app(ManagerTenant::class)->tenant();

        $query->where('tenant_id', $tenant->id);
    }
}
