<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'pic',
        'color',
    ];

  public function meeting():HasMany{
    return $this->hasMany(Meeting::class,'room_id');
  }
}
