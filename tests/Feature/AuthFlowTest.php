<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_is_redirected_to_the_store_after_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function a_regular_user_is_redirected_to_the_store_after_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function an_admin_user_is_redirected_to_the_dashboard_after_login()
    {
        $admin = User::factory()->create([
            'email' => 'admin1@admin.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin1@admin.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }
}
