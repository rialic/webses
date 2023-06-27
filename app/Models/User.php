<?php

namespace App\Models;

use App\Traits\HasResourceModel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_users';
    protected $tableColumnPrefix = 'us';
    protected $primaryKey = 'us_id';

    protected $appends = [
        'name',
        'email',
        'cpf',
        'cns',
        'verified_at',
        'status',
        'password',
    ];

    protected $fillable = [
        'us_name',
        'us_email',
        'us_password',
        'us_cpf',
        'us_cns',
        'us_verified_at',
        'us_status',
        'es_id',
        'cbo_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // RELATIONSHIPS
    public function tenants()
    {
        return $this->belongsToMany(Tenant::class, 'tb_tenant_users', 'us_id', 'te_id');
    }

    public function cbos()
    {
        return $this->belongsToMany(CBO::class, 'tb_establisment_users_cbo', 'us_id', 'cbo_id')->withPivot(['eu_primary_bond', 'eu_status']);
    }

    public function establishments()
    {
        return $this->belongsToMany(Establishment::class, 'tb_establisment_users_cbo', 'us_id', 'es_id')->withPivot(['eu_primary_bond', 'eu_status']);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'tb_user_roles', 'us_id', 'es_id');
    }
}