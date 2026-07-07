<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    // ========== REGISTER ==========

    /** @test */
    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('register');
    }

    /** @test */
    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post(route('kirimregister'), [
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status', 'success');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'Pelanggan',
        ]);
    }

    /** @test */
    public function test_register_fails_with_duplicate_email(): void
    {
        User::factory()->create([
            'email' => 'existing@example.com',
            'role' => 'Pelanggan',
        ]);

        $response = $this->post(route('kirimregister'), [
            'username' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function test_register_fails_without_required_fields(): void
    {
        $response = $this->post(route('kirimregister'), []);

        $response->assertSessionHasErrors(['username', 'email', 'password', 'confirm_password']);
    }

    /** @test */
    public function test_register_fails_when_password_confirmation_does_not_match(): void
    {
        $response = $this->post(route('kirimregister'), [
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'confirm_password' => 'different_password',
        ]);

        $response->assertSessionHasErrors('confirm_password');
    }

    /** @test */
    public function test_register_fails_with_short_password(): void
    {
        $response = $this->post(route('kirimregister'), [
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'confirm_password' => '123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    // ========== LOGIN ==========

    /** @test */
    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    /** @test */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Pelanggan',
        ]);

        $response = $this->post(route('kirimlogin'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Login Berhasil!');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Pelanggan',
        ]);

        $response = $this->post(route('kirimlogin'), [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'eror');
        $this->assertGuest();
    }

    /** @test */
    public function test_login_fails_with_nonexistent_email(): void
    {
        $response = $this->post(route('kirimlogin'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'eror');
        $this->assertGuest();
    }

    // ========== LOGOUT ==========

    /** @test */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create([
            'role' => 'Pelanggan',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('logout'));

        $response->assertStatus(200);
        $response->assertViewIs('login');
        $this->assertGuest();
    }
}
