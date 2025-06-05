<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class CompaniesControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_company_details_page_receives_company_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()
            ->has(Employee::factory()->count(2), 'employees')
            ->create([
                'id' => 1,
            ]);
        $company->load('employees');

        $response = $this->get('/companies/1');
        $response->assertStatus(200);

        $response->assertInertia(fn (AssertableInertia $page) =>
            $page->component('CompanyDetails')
                ->has('company', null, function (AssertableInertia $company) {
                    $company->hasAll(['id', 'name', 'abn', 'email', 'address']);
                    $company->has('employees', 2);
                })
        );
    }

    public function test_company_details_page_with_invalid_id_redirects_to_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Company::factory()->create(['id' => 1]);

        $response = $this->get('/companies/2');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_create_company_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/companies/new');
        $response->assertStatus(200);
    }
}
