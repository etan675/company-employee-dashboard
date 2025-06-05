<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Services\Interfaces\CompanyServiceInterface;
use App\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private CompanyServiceInterface $companyService;
    private EmployeeServiceInterface $employeeService;

    public function __construct(
        CompanyServiceInterface $companyService,
        EmployeeServiceInterface $employeeService
    ) {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $companiesCount = $this->companyService->getTotalCompaniesCount();
        $employeesCount = $this->employeeService->getTotalEmployeesCount();
        $companies = $this->companyService->getAllCompanies();

        return Inertia::render('Dashboard', [
            'companiesCount' => $companiesCount,
            'employeesCount' => $employeesCount,
            'companies' => CompanyResource::collection($companies)
        ]);
    }
}
