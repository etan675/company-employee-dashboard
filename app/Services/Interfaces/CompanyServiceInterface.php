<?php

namespace App\Services\Interfaces;

interface CompanyServiceInterface
{
    /**
     * Get all companies with their employees.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllCompanies();

    /**
     * Get number of companies in the database.
     *
     * @return int
     */
    public function getTotalCompaniesCount();

    /**
     * Get a company by its ID.
     *
     * @param int $id
     * 
     * @return \App\Models\Company|null
     */
    public function getCompanyById(int $id);

    /**
     * Create a new company.
     *
     * @param array $fields
     * 
     * @return \App\Models\Company|null
     */
    public function createCompany(array $fields);

    /**
     * Edit a company's fields.
     *
     * @param array $updateFields
     * 
     * @return \App\Models\Company|null
     */
    public function editCompany(int $id, array $updateFields);
}