<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Mockery\MockInterface;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_visit_the_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_dashboard_receives()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $companiesCount = 5;

        $this->mock(CompanyServiceInterface::class, fn (MockInterface $mock) =>
            $mock->expects('getTotalCompaniesCount')->andReturn($companiesCount)
        );

        $response = $this->get('/dashboard');
        $response->assertInertia(fn (AssertableInertia $page) => 
            $page->component('Dashboard')
                ->where('companiesCount', $companiesCount)
        );
    }
}
