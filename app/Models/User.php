<?php

namespace App\Models;

use App\Jobs\UserVerifyEmailJob;
use App\Models\Scopes\TenantScope;
use App\Observers\Global\GlobalObserver;
use App\Traits\HasResourceModel;
use App\Traits\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use VerifyEmail, HasApiTokens, HasFactory, Notifiable, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadof HasUuids; }

    protected $table = 'tb_users';
    protected $tableColumnPrefix = 'us';
    protected $primaryKey = 'us_id';
    protected $relationships = ['tenants', 'cbos', 'establishments', 'roles'];

    protected $appends = [
        'name',
        'first_name',
        'email',
        'cpf',
        'cns',
        'verified_at',
        'status',
        'password',
        'current_subdomain',
    ];

    protected $fillable = [
        'us_name',
        'us_email',
        'us_password',
        'us_cpf',
        'us_cns',
        'us_verified_at',
        'us_current_subdomain',
        'us_status',
        'es_id',
        'cbo_id'
    ];

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new TenantScope);
        // static::observe(new GlobalObserver);
    }

    // GETTERS
    public function getFirstNameAttribute()
    {
        return substr($this->name, 0, strpos($this->name, ' '));
    }

    // SETTERS
    public function setUsPasswordAttribute($value)
    {
        $this->attributes['us_password'] = bcrypt($value);
    }

    // RELATIONSHIPS
    public function tenants()
    {
        return $this->belongsToMany(Tenant::class, 'tb_tenant_users', 'us_id', 'tenant_id');
    }

    public function cbos()
    {
        return $this->belongsToMany(CBO::class, 'tb_establishment_users', 'us_id', 'cbo_id')->withPivot(['eu_primary_bond']);
    }

    public function establishments()
    {
        return $this->belongsToMany(Establishment::class, 'tb_establishment_users', 'us_id', 'es_id')->withPivot(['eu_primary_bond']);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'tb_user_roles', 'us_id', 'ro_id');
    }
}
