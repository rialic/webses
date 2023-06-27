<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_modules';
    protected $tableColumnPrefix = 'mo';
    protected $primaryKey = 'mo_id';

    protected $appends = [
        'name',
        'status'
    ];

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class, 'tb_tenant_modules', 'mo_id', 'te_id');
    }
}
