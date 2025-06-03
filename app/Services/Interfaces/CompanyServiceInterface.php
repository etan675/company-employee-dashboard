<?php

namespace App\Services\Interfaces;

interface CompanyServiceInterface
{
    /**
     * Get all companies with their employees.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCompanies();

    /**
     * Get number of companies in the database.
     *
     * @return int
     */
    public function getTotalCompaniesCount();
}