<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_tenants';
    protected $tableColumnPrefix = 'tenant';
    protected $primaryKey = 'tenant_id';

    protected $appends = [
        'name',
        'subdomain',
        'status'
    ];

    protected $fillable = [
        'tenant_name',
        'tenant_subdomain',
        'tenant_status'
    ];

    // RELATIONSHIPS
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'tb_tenant_modules', 'tenant_id', 'mo_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tb_tenant_modules', 'tenant_id', 'us_id');
    }
}
