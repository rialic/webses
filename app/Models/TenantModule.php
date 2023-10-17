<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantModule extends Model
{
    use HasFactory, HasResourceModel;

    protected $table = 'tb_tenant_modules';
    protected $tableColumnPrefix = 'tm';
    protected $primaryKey = 'tm_id';

    protected $fillable = [
        'tenant_id',
        'mo_id',
        'tm_status'
    ];
}
