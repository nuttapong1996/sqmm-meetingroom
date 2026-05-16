<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function isAdmin(): bool
    {
        $adminUser = config('auth.admin_users');
        return in_array($this->code_emp, $adminUser);
    }

    public function meeting():HasMany{
        return $this->hasMany(Meeting::class ,'emp_code');
    }
}
