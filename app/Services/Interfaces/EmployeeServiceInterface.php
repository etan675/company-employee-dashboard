<?php

namespace App\Services\Interfaces;

interface EmployeeServiceInterface
{
    /**
     * Get the total number of employees in the database.
     *
     * @return int
     */
    public function getTotalEmployeesCount();

    /**
     * Get an employee by Id.
     * 
     * @param int $id
     * 
     * @return \App\Models\Employee|null
     */
    public function getEmployeeById(int $id);

    /**
     * Create an employee in a company.
     * 
     * @param array $fields
     * @param int $companyId
     * 
     * @return \App\Models\Employee|null
     */
    public function createEmployee(array $fields, int $companyId);

     /**
     * Delete an employee in a company.
     * 
     * @param int $employeeId
     * @param int $companyId
     * 
     * @return int
     */
    public function deleteEmployee(int $employeeId, int $companyId);
}