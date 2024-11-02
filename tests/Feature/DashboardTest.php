<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_dashboard()
    {
        // Create a user instance
        $user = User::factory()->create();

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the /dashboard route
        $response = $this->get('/dashboard');

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response contains the expected message
        // $response->assertJson(['message' => 'Welcome to your dashboard']);
    }

    public function test_guest_cannot_access_dashboard()
    {
        // Send a GET request to the /dashboard route without authentication
        $response = $this->get('/dashboard');

        // Assert that the response status is a redirect to the login page (default behavior)
        $response->assertRedirect('/login');
    }
}
