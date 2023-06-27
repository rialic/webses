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
    protected $tableColumnPrefix = 'te';
    protected $primaryKey = 'te_id';

    protected $appends = [
        'name',
        'subdomain',
        'status'
    ];

    protected $fillable = [
        'te_name',
        'te_subdomain',
        'te_status'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'tb_tenant_modules', 'te_id', 'mo_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tb_tenant_modules', 'te_id', 'us_id');
    }
}
