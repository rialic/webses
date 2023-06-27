<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_states';
    protected $tableColumnPrefix = 'st';
    protected $primaryKey = 'st_id';

    protected $appends = [
        'name',
        'acronym',
        'status'
    ];

    protected $fillable = [
        'st_name',
        'st_acronym',
        'st_status'
    ];

    // RELATIONSHIPS
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
