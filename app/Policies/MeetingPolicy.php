<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Meeting;
use Illuminate\Auth\Access\Response;

class MeetingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Employee $employee, Meeting $meeting): bool
    {
        // dd([$employee->code_emp, $meeting->emp_code]);
        return $employee->code_emp == $meeting->emp_code || $employee->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $employee): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $employee, Meeting $meeting): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Employee $employee, Meeting $meeting): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Employee $employee, Meeting $meeting): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Employee $employee, Meeting $meeting): bool
    {
        return false;
    }
}
