<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory, HasResourceModel;

    protected $table = 'tb_role_permissions';
    protected $tableColumnPrefix = 'rp';
    protected $primaryKey = 'rp_id';

    protected $fillable = [
        'ro_id',
        'pe_id',
        'tenant_id',
        'rp_status'
    ];
}
