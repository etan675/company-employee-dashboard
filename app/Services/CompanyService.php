<?php

namespace App\Services;

use App\Models\Company;
use App\Services\Interfaces\CompanyServiceInterface;
use Exception;

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

    /**
     * Create a new company.
     * 
     * @param array $fields
     * 
     * @return \App\Models\Company|null
     */
    public function createCompany(array $fields)
    {
        try {
            return Company::create($fields);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Edit a company's fields.
     *
     * @param array $updateFields
     * 
     * @return \App\Models\Company|null
     */
    public function editCompany(int $id, array $updateFields)
    {
        $company = $this->getCompanyById($id);
        
        if (!$company) {
            return null;
        }

        try {
            $company->fill($updateFields);
            $company->save();

            return $company->fresh(['employees']);
        } catch (Exception $e) {
            return null;
        }
    }
}