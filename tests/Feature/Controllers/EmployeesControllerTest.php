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

    public function test_employees_details_page_gets_employees_and_company_data()
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

    public function test_create_employee_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Company::factory()->create();

        $response = $this->get('companies/1/employees/new');
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('CreateEmployee')
                ->has('company', null, function (AssertableJson $company) {
                    $company->hasAll(['id', 'name'])->etc();
                });
        });
    }

    public function test_store_valid_record_redirects_to_employee_details()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();

        $requestData = [
            'firstName' => 'john',
            'lastName' => 'smith',
            'email' => 'john@test.com',
            'address' => '123 test street',
        ];

        $response = $this->post(route('employees.store', ['companyId' => $company->id]), $requestData);

        $response->assertStatus(302);
        $response->assertRedirect("/companies/{$company->id}/employees/1");
    }

    public function test_delete_employee_redirects_to_company_details()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->has(Employee::factory())->create();

        $response = $this->delete(route('employees.destroy', [
            'companyId' => $company->id,
            'employeeId' => 1
        ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('companies.show', ['id' => $company->id]));
    }
}
