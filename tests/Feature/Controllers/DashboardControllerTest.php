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

        $companies = Company::factory()
            ->has(Employee::factory()->count(2), 'employees')
            ->count(2)
            ->create();
        $companies->load('employees');

        $this->mock(CompanyServiceInterface::class, function (MockInterface $mock) use ($companies) {
            $mock->expects('getTotalCompaniesCount')->andReturn(2);
            $mock->expects('getAllCompanies')->andReturn($companies);
        });

        $this->mock(EmployeeServiceInterface::class, fn (MockInterface $mock) =>
            $mock->expects('getTotalEmployeesCount')->andReturn(4)
        );

        $response = $this->get('/dashboard');

        $response->assertInertia(fn (AssertableInertia $page) => 
            $page->component('Dashboard')
                ->where('companiesCount', 2)
                ->where('employeesCount', 4)
                ->has('companies.data', 2, function (AssertableInertia $company) {
                    $company->has('employees', 2);
                    $company->has('name')->etc();
                })
        );
    }
}
