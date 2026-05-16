<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $connection = 'employee';
    protected $table = 'tbl_dept_emp';
    protected $primaryKey = 'code_tbl_deptemp';
    protected $keyType = 'string';


    public function meeting():HasMany{
        return $this->hasMany(Meeting::class , 'dept');
    }
}
