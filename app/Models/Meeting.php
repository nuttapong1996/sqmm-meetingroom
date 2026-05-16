<?php

namespace App\Models;

use App\Models\RoomStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'emp_code',
        'dept',
        'room_status_id',
        'start_time',
        'end_time',
        'zoom_use',
        'link_zoom',
        'audio_system',
        'other_equipment',

    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(RoomStatus::class, 'room_status_id');
    }

    public function room():BelongsTo{
        return $this->belongsTo(Room::class ,'room_id');
    }

    public function employee():BelongsTo{
        return $this->belongsTo(Employee::class ,'emp_code');
    }

    public function department():BelongsTo{
        return $this->belongsTo(Department::class , 'dept');
    }
}
