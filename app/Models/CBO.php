<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CBO extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_cbo';
    protected $tableColumnPrefix = 'cbo';
    protected $primaryKey = 'cbo_id';

    protected $appends = [
        'name',
        'code',
        'status'
    ];

    protected $fillable = [
        'cbo_name',
        'cbo_code',
        'cbo_status'
    ];

    // RELATIONSHIP
    public function users()
    {
        $this->belongsToMany(User::class, 'tb_establisment_users_cbo', 'co_id', 'us_id');
    }
}
