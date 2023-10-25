<?php

namespace App\Repository;

use App\Models\Module;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\ModuleInterface;
use Illuminate\Support\Facades\Log;

class ModuleRepository extends DBRepository implements ModuleInterface
{
    protected function model()
    {
        return Module::class;
    }

    public function query($params = [])
    {
        $tenant = app('App\Tenant\ManagerTenant')->tenant();
        $query = parent::query($params);

        return $query->whereRelation('tenants', 'tb_tenant_modules.tenant_id', $tenant->id)
            ->with('submodules');
    }
}
