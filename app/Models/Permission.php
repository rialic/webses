<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_permissions';
    protected $tableColumnPrefix = 'pe';
    protected $primaryKey = 'pe_id';

    protected $appends = [
        'name',
        'status'
    ];

    protected $fillable = [
        'pe_name',
        'pe_status'
    ];

    public function roles()
    {
        return $this->belongsToMany('tb_role_permissions', 'pe_id', 'ro_id');
    }
}
