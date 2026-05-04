<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $connection = 'employee';
    protected $table = 'tbl_emp';
    protected $primaryKey = 'code_emp';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
