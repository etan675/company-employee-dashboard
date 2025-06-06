<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Http\Resources\EmployeeResource;
use App\Services\Interfaces\CompanyServiceInterface;
use App\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeesController extends Controller
{
    private EmployeeServiceInterface $employeeService;
    private CompanyServiceInterface $companyService;

    public function __construct(
        EmployeeServiceInterface $employeeService,
        CompanyServiceInterface $companyService
    ){
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
    }

    public function show(string $companyId, string $employeeId)
    {
        $employee = $this->employeeService->getEmployeeById((int) $employeeId);
        $company = $this->companyService->getCompanyById((int) $companyId);

        if (!$employee) {
            return redirect()->route('companies.show', ['id' => $companyId])->with('error', 'Company not found');
        }

        return Inertia::render('EmployeeDetails', [
            'employee' => new EmployeeResource($employee),
            'company' => new CompanyResource($company)
        ]);
    }

    public function create(string $companyId)
    {
        $company = $this->companyService->getCompanyById((int) $companyId);

        return Inertia::render('CreateEmployee', [
            'company' => new CompanyResource($company)
        ]);
    }
}
