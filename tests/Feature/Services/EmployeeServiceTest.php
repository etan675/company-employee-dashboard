<?php

namespace Tests\Feature\Services;

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
}
