<?php

namespace App\Models;

use App\Traits\HasResourceModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUuids, HasResourceModel { HasResourceModel::uniqueIds insteadOf HasUuids; }

    protected $table = 'tb_events';
    protected $tableColumnPrefix = 'ev';
    protected $primaryKey = 'ev_id';
    protected $relationships = ['tenants', 'user'];

    protected $appends = [
        'name',
        'status',
        'bireme_code',
        'start_at',
        'start_at_formatted',
        'start_minutes_additions',
        'end_at',
        'end_at_formatted',
        'end_minutes_additions',
        'virtual_room',
        'description',
        'room_link'
    ];

    protected $fillable = [
        'ev_name',
        'ev_status',
        'ev_bireme_code',
        'ev_start_at',
        'ev_start_minutes_additions',
        'ev_end_at',
        'ev_end_minutes_additions',
        'ev_virtual_room',
        'ev_room_link',
        'created_by',
        'tenant_id'
    ];

    // GETTERS
    public function getStartAtFormattedAttribute()
    {
        return $this->getDateTimeFormatted($this->start_at);
    }

    public function getEndAtFormattedAttribute()
    {
        return $this->getDateTimeFormatted($this->end_at);
    }

    // RELATIONSHIPS
    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'tb_event_participants', 'ev_id', 'us_id');
    }
}
