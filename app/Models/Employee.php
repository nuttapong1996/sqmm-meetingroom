<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'employee';
    protected $table = 'tbl_emp';
    protected $primaryKey = 'code_emp';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
}
