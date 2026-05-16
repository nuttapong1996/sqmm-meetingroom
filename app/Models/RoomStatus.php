<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomStatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function meeting():HasMany{
        return $this->hasMany(Meeting::class ,'room_status_id');
    }
}
