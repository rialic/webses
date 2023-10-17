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
    protected $relationships = ['city'];

    protected $appends = [
        'name',
        'status',
        'cnes',
        'datacnes_id',
        'legal_nature'
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
        return $this->belongsTo(City::class, 'ci_id', 'ci_id')->withDefault();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tb_establishment_users', 'es_id', 'us_id')->withPivot(['eu_primary_bond']);
    }
}