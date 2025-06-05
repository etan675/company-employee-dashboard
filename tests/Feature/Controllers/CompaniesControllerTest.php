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

    public function test_create_company_page_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/companies/new');
        $response->assertStatus(200);
    }

    public function test_edit_company_page_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create(['id' => 1]);

        $response = $this->get('/companies/1/edit');
        $response->assertStatus(200);
    }

    public function test_store_valid_record_redirects_to_company_details()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $requestData = [
            'name' => 'test company 1',
            'abn' => '123456789',
            'email' => 'contact@testcompany1.com',
            'address' => '123 Test St',
        ];

        $response = $this->post('/companies', $requestData);

        $response->assertStatus(302);
        $response->assertRedirect('/companies/1');
    }

    public function test_store_invalid_record_has_validation_errors_and_redirects()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Company::factory()->create(['abn' => '1234']);
        $requestData = [
            'name' => '',
            'abn' => '1234',
            'email' => 'invalid email',
        ];

        $response = $this->post('/companies', $requestData);

        $response->assertSessionHasErrors(['name', 'abn', 'email']);
        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
