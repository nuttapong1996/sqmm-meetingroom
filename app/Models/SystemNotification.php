<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class SystemNotification extends DatabaseNotification
{
    protected $connection = 'sqlite';
}
