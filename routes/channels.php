<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('App.Models.Employee.{code_emp}', function (Employee $emp, $code_emp) {
    return (string) $emp->code_emp === (string) $code_emp;
});
