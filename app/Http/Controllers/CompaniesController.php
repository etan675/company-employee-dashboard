<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompaniesController extends Controller
{
    private CompanyServiceInterface $companyService;

    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    public function show(string $id)
    {
        $company = $this->companyService->getCompanyById($id);

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'Company not found');
        }

        return Inertia::render('CompanyDetails', [
            'company' => new CompanyResource($company)
        ]);
    }

    public function create()
    {
        return Inertia::render('CreateCompany');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'abn' => ['required', 'string', 'unique:companies,abn'],
            'email' => ['required', 'email', 'unique:companies,email'],
            'address' => ['nullable', 'string'],
        ]);

        $company = $this->companyService->createCompany($validatedData);

        return redirect()->route('companies.show', ['id' => $company->id]);
    }

    public function edit(string $id)
    {
        return Inertia::render('EditCompany');
    }
}
