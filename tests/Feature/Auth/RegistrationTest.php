<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        // Create Warga role for registration
        Role::create([
            'name' => 'Warga',
            'display_name' => 'Warga',
            'description' => 'Role untuk warga'
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'nik' => '1234567890123456',
            'phone' => '081234567890',
            'address' => 'Jl. Test No. 123, Jakarta',
            'birth_date' => '1990-01-01',
            'gender' => 'L',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
