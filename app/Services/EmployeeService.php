<?php

namespace App\Services;

use App\Models\Employee;
use App\Services\Interfaces\EmployeeServiceInterface;
use Exception;

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
    
    /**
     * Get an employee by Id.
     * 
     * @param int $id
     * 
     * @return \App\Models\Employee|null
     */
    public function getEmployeeById(int $id)
    {
        return Employee::find($id);
    }

    /**
     * Create an employee in a company.
     * 
     * @param array $fields
     * @param int $companyId
     * 
     * @return \App\Models\Employee|null
     */
    public function createEmployee(array $fields, int $companyId)
    {
        try {
            $fields['company_id'] = $companyId;
            return Employee::create($fields);
        } catch (Exception $e) {
            return null;
        }
    }
}