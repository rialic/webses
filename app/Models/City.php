<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_cities';
    protected $tableColumnPrefix = 'ci';
    protected $primaryKey = 'ci_id';

    protected $appends = [
        'name',
        'macro_region_id',
        'micro_region_id',
        'datacnes_id',
        'status'
    ];

    protected $fillable = [
        'ci_name',
        'ci_status',
        'ci_datacnes_id',
        'ci_macro_region_id',
        'ci_micro_region_id',
        'st_id'
    ];

    // RELATIONSHIPS
    public function state()
    {
        return $this->belongsTo(State::class, 'st_id', 'st_id');
    }

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
