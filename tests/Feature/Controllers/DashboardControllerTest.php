<?php

namespace Tests\Feature\Controllers;

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
        $employeesCount = 10;

        // fake companies data
        $companies = [
            ['name' => 'Company 1'],
            ['name' => 'Company 2'],
            ['name' => 'Company 3'],
            ['name' => 'Company 4'],
            ['name' => 'Company 5'],
        ];

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
                ->where('companies', $companies)
        );
    }
}
