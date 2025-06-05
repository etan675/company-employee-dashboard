<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompaniesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $response = $this->get('/companies/1');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_see_company_details_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Company::factory()
            ->has(Employee::factory()->count(2), 'employees')
            ->create([
                'id' => 1
            ]);

        $response = $this->get('/companies/1');
        $response->assertStatus(200);   
    }
}
