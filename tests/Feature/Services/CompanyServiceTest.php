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

        $this->assertCount(1, $companies);
        $this->assertCount(2, $companies->first()->employees);
    }

    public function test_create_company_inserts_to_database_correctly()
    {
        $newCompanyData = [
            'name' => 'test company 1',
            'abn' => '0123456789',
            'email' => 'contact@testcompany1.com',
            'address' => '123 Test St',
        ];

        $created = $this->companyService->createCompany($newCompanyData);
        $created2 = $this->companyService->createCompany($newCompanyData);

        $this->assertDatabaseHas('companies', [
            'id' => $created->id,
            'name' => $newCompanyData['name'],
            'abn' => $newCompanyData['abn'],
            'email' => $newCompanyData['email'],
            'address' => $newCompanyData['address'],
        ]);
        $this->assertEquals($created2, null, 'failed insert should return null');
    }

    public function test_edit_company_updates_database_correctly()
    {
        $c1 = Company::factory()->create([
            'name' => 'company 1',
            'abn' => '1234',
            'email' => 'contact@company1.com'
        ]);
        $c2 = Company::factory()->create([
            'name' => 'company 2',
            'abn' => '1235',
            'email' => 'contact@company2.com'
        ]);

        $updateFields = ['name' => 'test company 1'];
        $updateFieldsDuplicate = ['abn' => '1235'];

        $updated = $this->companyService->editCompany($c1->id, $updateFields);
        $updated2 = $this->companyService->editCompany($c1->id, $updateFieldsDuplicate);

        $this->assertEquals($updated->name, $updateFields['name'], 'company name is updated');
        $this->assertEquals($updated2, null, 'duplicate abn should fail and return null');
    }
}
