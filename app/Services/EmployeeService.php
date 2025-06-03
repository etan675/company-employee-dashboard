<?php

namespace App\Services;

use App\Models\Employee;
use App\Services\Interfaces\EmployeeServiceInterface;

class EmployeeService implements EmployeeServiceInterface
{
    /**
     * Get the total number of employees in the database.
     *
     * @return int
     */
    public function getTotalEmployeesCount()
    {
        return Employee::count();
    }
}