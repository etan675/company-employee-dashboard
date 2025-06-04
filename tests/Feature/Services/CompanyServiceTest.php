<?php

namespace Tests\Feature\Services;

use App\Models\Company;
use App\Models\Employee;
use App\Services\CompanyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyServiceTest extends TestCase
{
    use RefreshDatabase;

    private CompanyService $companyService;

    public function setUp(): void
    {
        parent::setUp();
        $this->companyService = new CompanyService();
    }

    public function test_get_total_companies_count()
    {
        Company::factory()->count(5)->create();
        $count = $this->companyService->getTotalCompaniesCount();

        $this->assertEquals(5, $count);
    }

    public function test_get_all_companies()
    {
        Company::factory()->has(Employee::factory()->count(2))->create();
        $companies = $this->companyService->getAllCompanies();

        dump($companies);

        $this->assertCount(1, $companies);
        $this->assertCount(2, $companies[0]['employees']);
    }
}
