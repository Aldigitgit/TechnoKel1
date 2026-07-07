<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'administrator',
        ]);
    }

    // ========== AUTHORIZATION ==========

    /** @test */
    public function test_unauthenticated_user_cannot_access_admin_pages(): void
    {
        $response = $this->get(route('admin.list'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_non_admin_user_cannot_access_admin_pages(): void
    {
        $pelanggan = User::factory()->create(['role' => 'Pelanggan']);

        $response = $this->actingAs($pelanggan)->get(route('admin.list'));
        $response->assertStatus(403);
    }

    // ========== INDEX ==========

    /** @test */
    public function test_admin_can_view_user_list(): void
    {
        User::factory()->count(5)->create(['role' => 'Pelanggan']);

        $response = $this->actingAs($this->admin)->get(route('admin.list'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.admin.index');
        $response->assertViewHas('dataadmin');
    }

    /** @test */
    public function test_admin_list_can_filter_by_role(): void
    {
        User::factory()->count(3)->create(['role' => 'Pelanggan']);
        User::factory()->count(2)->create(['role' => 'Mitra']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.list', ['role' => 'Pelanggan']));

        $response->assertStatus(200);
        $dataadmin = $response->viewData('dataadmin');
        foreach ($dataadmin as $user) {
            $this->assertEquals('Pelanggan', $user->role);
        }
    }

    // ========== CREATE ==========

    /** @test */
    public function test_admin_can_view_create_form(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.admin.create');
    }

    // ========== STORE ==========

    /** @test */
    public function test_admin_can_store_new_user(): void
    {
        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'role' => 'Pelanggan',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), $userData);

        $response->assertRedirect(route('admin.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'role' => 'Pelanggan',
        ]);
    }

    /** @test */
    public function test_admin_can_store_user_with_administrator_role(): void
    {
        $userData = [
            'name' => 'New Admin',
            'email' => 'newadmin@example.com',
            'password' => 'password123',
            'role' => 'administrator',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), $userData);

        $response->assertRedirect(route('admin.list'));
        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@example.com',
            'role' => 'administrator',
        ]);
    }

    /** @test */
    public function test_admin_can_store_user_with_mitra_role(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), [
                'name' => 'Mitra User',
                'email' => 'mitra@example.com',
                'password' => 'password123',
                'role' => 'Mitra',
            ]);

        $response->assertRedirect(route('admin.list'));
        $this->assertDatabaseHas('users', [
            'email' => 'mitra@example.com',
            'role' => 'Mitra',
        ]);
    }

    /** @test */
    public function test_store_user_fails_with_invalid_data(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), [
                'name' => '',
                'email' => 'not-email',
                'password' => '123',
                'role' => 'invalid_role',
            ]);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
    }

    /** @test */
    public function test_store_user_fails_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'duplicate@example.com']);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), [
                'name' => 'Duplicate',
                'email' => 'duplicate@example.com',
                'password' => 'password123',
                'role' => 'Pelanggan',
            ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function test_store_user_fails_with_name_too_long(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.store'), [
                'name' => str_repeat('a', 31),
                'email' => 'test@example.com',
                'password' => 'password123',
                'role' => 'Pelanggan',
            ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function test_stored_user_password_is_hashed(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.store'), [
                'name' => 'Hash Test',
                'email' => 'hash@example.com',
                'password' => 'password123',
                'role' => 'Pelanggan',
            ]);

        $user = User::where('email', 'hash@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertNotEquals('password123', $user->password);
    }

    // ========== EDIT ==========

    /** @test */
    public function test_admin_can_view_edit_form(): void
    {
        $user = User::factory()->create(['role' => 'Pelanggan']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.edit', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.admin.edit');
        $response->assertViewHas('dataadmin');
    }

    /** @test */
    public function test_edit_form_returns_404_for_nonexistent_user(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.edit', 99999));

        $response->assertStatus(404);
    }

    // ========== UPDATE ==========

    /** @test */
    public function test_admin_can_update_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'role' => 'Pelanggan',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.update'), [
                'user_id' => $user->id,
                'name' => 'New Name',
                'email' => 'new@example.com',
                'role' => 'Mitra',
            ]);

        $response->assertRedirect(route('admin.list'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('new@example.com', $user->email);
        $this->assertEquals('Mitra', $user->role);
    }

    /** @test */
    public function test_admin_can_update_user_with_password(): void
    {
        $user = User::factory()->create(['role' => 'Pelanggan']);

        $this->actingAs($this->admin)
            ->post(route('admin.update'), [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'newpassword123',
                'role' => $user->role,
            ]);

        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    /** @test */
    public function test_admin_can_update_user_without_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('original_password'),
            'role' => 'Pelanggan',
        ]);

        $this->actingAs($this->admin)
            ->post(route('admin.update'), [
                'user_id' => $user->id,
                'name' => 'Updated Name',
                'email' => $user->email,
                'role' => $user->role,
            ]);

        $user->refresh();
        $this->assertTrue(Hash::check('original_password', $user->password));
    }

    /** @test */
    public function test_admin_cannot_change_own_role(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.update'), [
                'user_id' => $this->admin->id,
                'name' => $this->admin->name,
                'email' => $this->admin->email,
                'role' => 'Pelanggan',  // Trying to change own role
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        $this->admin->refresh();
        $this->assertEquals('administrator', $this->admin->role);
    }

    /** @test */
    public function test_update_user_validation_fails_with_invalid_data(): void
    {
        $user = User::factory()->create(['role' => 'Pelanggan']);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.update'), [
                'user_id' => $user->id,
                'name' => '',
                'email' => 'not-email',
                'role' => 'invalid',
            ]);

        $response->assertSessionHasErrors(['name', 'email', 'role']);
    }

    // ========== DESTROY ==========

    /** @test */
    public function test_admin_can_delete_user(): void
    {
        $user = User::factory()->create(['role' => 'Pelanggan']);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.destroy', $user->id));

        $response->assertRedirect(route('admin.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function test_admin_cannot_delete_own_account(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('admin.destroy', $this->admin->id));

        $response->assertRedirect(route('admin.list'));
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }

    /** @test */
    public function test_delete_nonexistent_user_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('admin.destroy', 99999));

        $response->assertStatus(404);
    }
}
