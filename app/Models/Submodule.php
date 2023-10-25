<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_submodules';
    protected $tableColumnPrefix = 'sub';
    protected $primaryKey = 'sub_id';
    protected $relationships = ['module'];

    protected $appends = [
        'name',
        'status'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'mo_id', 'mo_id');
    }
}
