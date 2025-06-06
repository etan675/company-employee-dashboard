<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class EmployeesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_employees_details_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['first_name' => 'john', 'company_id' => $company->id]);

        $response = $this->get('companies/1/employees/1');
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('EmployeeDetails')
                ->has('employee', null, function (AssertableJson $employee) {
                    $employee->hasAll(['id', 'firstName', 'lastName', 'email', 'address', 'companyId']);
                })
                ->has('company', null, function (AssertableJson $company) {
                    $company->hasAll(['id', 'name'])->etc();
                });
        });
    }
}
