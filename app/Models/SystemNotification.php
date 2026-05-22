<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

class SystemNotification extends DatabaseNotification
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        // ดึงค่า Default Connection จาก Config (ซึ่งจะอ่านจาก .env มาให้)
        // วิธีนี้ช่วยป้องกันไม่ให้ Model สืบทอด Connection มาจาก Model Employee
        $this->connection = config('database.default');
    }
}
