<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private CompanyServiceInterface $companyService;

    public function __construct(CompanyServiceInterface $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        $companiesCount = $this->companyService->getTotalCompaniesCount();

        return Inertia::render('Dashboard', [
            'companiesCount' => $companiesCount,
        ]);
    }
}
