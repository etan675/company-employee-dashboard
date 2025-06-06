<?php

namespace Tests\Feature\Services;

use App\Models\Company;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeServiceTest extends TestCase
{
    use RefreshDatabase;

    private EmployeeService $employeeService;

    public function setUp(): void
    {
        parent::setUp();
        $this->employeeService = new EmployeeService();
    }

    public function test_get_employee_by_id()
    {
        $employee = Employee::factory()->create();

        $fetched = $this->employeeService->getEmployeeById(1);

        $this->assertEquals($employee->email, $fetched->email);
    }

    public function test_create_employee_inserts_to_database_correctly()
    {
        $company = Company::factory()->create();
        $newEmployeeData = [
            'first_name' => 'john',
            'last_name' => 'smith',
            'email' => 'john@test.com',
            'address' => '123 Test St',
        ];

        $created = $this->employeeService->createEmployee($newEmployeeData, $company->id);
        $created2 = $this->employeeService->createEmployee($newEmployeeData, $company->id);

        $this->assertDatabaseHas('employees', [
            'id' => 1,
            'first_name'=> $newEmployeeData['first_name'],
            'last_name'=> $newEmployeeData['last_name'],
            'email'=> $newEmployeeData['email'],
            'address'=> $newEmployeeData['address'],
            'company_id' =>$company->id
        ]);
        $this->assertEquals($created2, null, 'failed insert should return null');
    }

    public function test_delete_employee_deletes_record_from_database_correctly()
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $deletedId = $this->employeeService->deleteEmployee($employee->id, $company->id);

        $this->assertEquals($employee->id, $deletedId, 'returned id should match deleted id');
        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id
        ]);
    }

    public function test_deleting_employee_not_found_in_company_fails()
    {
        $company1 = Company::factory()->create();
        $company2 = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company2]);

        $deletedId = $this->employeeService->deleteEmployee($employee->id, $company1->id);

        $this->assertEquals(0, $deletedId, 'failed delete should return 0');
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id
        ]);
    }
}
