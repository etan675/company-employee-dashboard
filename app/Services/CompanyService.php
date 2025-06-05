<?php

namespace App\Services;

use App\Models\Company;
use App\Services\Interfaces\CompanyServiceInterface;

class CompanyService implements CompanyServiceInterface
{
    /**
     * Get all companies with their employees.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCompanies()
    {
        return Company::with('employees')->get();
    }

    /**
     * Get number of companies in the database.
     * 
     * @return int
     */
    public function getTotalCompaniesCount()
    {
        return Company::count();
    }

    /**
     * Get a company (with its employees) by its ID.
     * 
     * @param int $id
     * 
     * @return \App\Models\Company|null
     */
    public function getCompanyById(int $id)
    {
        return Company::with('employees')->find($id);
    }
}