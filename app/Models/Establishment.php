<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_establishments';
    protected $tableColumnPrefix = 'es';
    protected $primaryKey = 'es_id';

    protected $appends = [
        'name',
        'status',
        'cnes',
        'datacnes_id'
    ];

    protected $fillable = [
        'es_name',
        'es_status',
        'es_cnes',
        'es_datacnes_id'
    ];

    // RELATIONSHIPS
    public function city()
    {
        return $this->belongsTo(City::class, 'es_id', 'es_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tb_establisment_users_cbo', 'es_id', 'us_id')->withPivot(['eu_primary_bond', 'eu_status']);
    }
}
