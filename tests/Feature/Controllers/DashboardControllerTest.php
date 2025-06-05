<?php

namespace Tests\Feature\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Services\Interfaces\CompanyServiceInterface;
use App\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Mockery\MockInterface;
use Tests\TestCase;


class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_receives_companies_and_employees_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $companiesCount = 5;
        $employeesPerCompany = 2;
        $employeesCount = 10;

        $companies = Company::factory()
            ->has(Employee::factory()->count($employeesPerCompany), 'employees')
            ->count($companiesCount)
            ->create();
        $companies->load('employees');

        $this->mock(CompanyServiceInterface::class, function (MockInterface $mock) use ($companiesCount, $companies) {
            $mock->expects('getTotalCompaniesCount')->andReturn($companiesCount);
            $mock->expects('getAllCompanies')->andReturn($companies);
        });

        $this->mock(EmployeeServiceInterface::class, fn (MockInterface $mock) =>
            $mock->expects('getTotalEmployeesCount')->andReturn($employeesCount)
        );

        $response = $this->get('/dashboard');

        $response->assertInertia(fn (AssertableInertia $page) => 
            $page->component('Dashboard')
                ->where('companiesCount', $companiesCount)
                ->where('employeesCount', $employeesCount)
                ->has('companies.data', $companiesCount, function (AssertableInertia $company) {
                    $company->has('employees', 2)->etc();
                })
        );
    }
}
