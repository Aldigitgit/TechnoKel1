<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelangganControllerTest extends TestCase
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
    public function test_unauthenticated_user_cannot_access_pelanggan_pages(): void
    {
        $response = $this->get(route('pelanggan.list'));
        $response->assertRedirect(route('login'));
    }

    // ========== INDEX ==========

    /** @test */
    public function test_can_view_pelanggan_list(): void
    {
        Pelanggan::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get(route('pelanggan.list'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pelanggan.index');
        $response->assertViewHas('datapelanggan');
    }

    /** @test */
    public function test_pelanggan_list_can_filter_by_gender(): void
    {
        Pelanggan::factory()->count(3)->create(['gender' => 'Male']);
        Pelanggan::factory()->count(2)->create(['gender' => 'Female']);

        $response = $this->actingAs($this->admin)
            ->get(route('pelanggan.list', ['gender' => 'Male']));

        $response->assertStatus(200);
        $datapelanggan = $response->viewData('datapelanggan');
        foreach ($datapelanggan as $pelanggan) {
            $this->assertEquals('Male', $pelanggan->gender);
        }
    }

    /** @test */
    public function test_pelanggan_list_can_search_by_name(): void
    {
        Pelanggan::factory()->create(['first_name' => 'Budi', 'last_name' => 'Santoso']);
        Pelanggan::factory()->create(['first_name' => 'Ani', 'last_name' => 'Rahayu']);

        $response = $this->actingAs($this->admin)
            ->get(route('pelanggan.list', ['search' => 'Budi']));

        $response->assertStatus(200);
        $datapelanggan = $response->viewData('datapelanggan');
        $this->assertEquals(1, $datapelanggan->total());
    }

    /** @test */
    public function test_pelanggan_list_can_search_by_email(): void
    {
        Pelanggan::factory()->create(['email' => 'budi@example.com']);
        Pelanggan::factory()->create(['email' => 'ani@example.com']);

        $response = $this->actingAs($this->admin)
            ->get(route('pelanggan.list', ['search' => 'budi@']));

        $response->assertStatus(200);
        $datapelanggan = $response->viewData('datapelanggan');
        $this->assertEquals(1, $datapelanggan->total());
    }

    /** @test */
    public function test_pelanggan_list_is_paginated(): void
    {
        Pelanggan::factory()->count(15)->create();

        $response = $this->actingAs($this->admin)->get(route('pelanggan.list'));

        $datapelanggan = $response->viewData('datapelanggan');
        $this->assertEquals(10, $datapelanggan->perPage());
        $this->assertEquals(15, $datapelanggan->total());
    }

    // ========== CREATE ==========

    /** @test */
    public function test_can_view_create_pelanggan_form(): void
    {
        $response = $this->actingAs($this->admin)->get(route('pelanggan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pelanggan.create');
    }

    // ========== STORE ==========

    /** @test */
    public function test_can_store_new_pelanggan(): void
    {
        $data = [
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'birthday' => '1990-05-15',
            'gender' => 'Male',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.store'), $data);

        $response->assertRedirect(route('pelanggan.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pelanggan', [
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'email' => 'budi@example.com',
        ]);
    }

    /** @test */
    public function test_store_pelanggan_fails_without_required_fields(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.store'), []);

        $response->assertSessionHasErrors([
            'first_name', 'last_name', 'birthday', 'gender', 'email', 'phone',
        ]);
    }

    /** @test */
    public function test_store_pelanggan_fails_with_invalid_gender(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.store'), [
                'first_name' => 'Test',
                'last_name' => 'User',
                'birthday' => '1990-05-15',
                'gender' => 'Other', // Invalid
                'email' => 'test@example.com',
                'phone' => '081234567890',
            ]);

        $response->assertSessionHasErrors('gender');
    }

    /** @test */
    public function test_store_pelanggan_fails_with_future_birthday(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.store'), [
                'first_name' => 'Test',
                'last_name' => 'User',
                'birthday' => '2030-05-15', // Future date
                'gender' => 'Male',
                'email' => 'test@example.com',
                'phone' => '081234567890',
            ]);

        $response->assertSessionHasErrors('birthday');
    }

    /** @test */
    public function test_store_pelanggan_fails_with_duplicate_email(): void
    {
        Pelanggan::factory()->create(['email' => 'existing@example.com']);

        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.store'), [
                'first_name' => 'Test',
                'last_name' => 'User',
                'birthday' => '1990-05-15',
                'gender' => 'Male',
                'email' => 'existing@example.com',
                'phone' => '081234567890',
            ]);

        $response->assertSessionHasErrors('email');
    }

    // ========== EDIT ==========

    /** @test */
    public function test_can_view_edit_pelanggan_form(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('pelanggan.edit', $pelanggan->pelanggan_id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pelanggan.edit');
        $response->assertViewHas('datapelanggan');
    }

    /** @test */
    public function test_edit_nonexistent_pelanggan_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('pelanggan.edit', 99999));

        $response->assertStatus(404);
    }

    // ========== UPDATE ==========

    /** @test */
    public function test_can_update_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create([
            'first_name' => 'Old First',
            'last_name' => 'Old Last',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.update'), [
                'pelanggan_id' => $pelanggan->pelanggan_id,
                'first_name' => 'New First',
                'last_name' => 'New Last',
                'birthday' => '1995-06-20',
                'gender' => 'Female',
                'email' => $pelanggan->email,
                'phone' => '089876543210',
            ]);

        $response->assertRedirect(route('pelanggan.list'));
        $response->assertSessionHas('success');

        $pelanggan->refresh();
        $this->assertEquals('New First', $pelanggan->first_name);
        $this->assertEquals('New Last', $pelanggan->last_name);
        $this->assertEquals('Female', $pelanggan->gender);
    }

    /** @test */
    public function test_update_pelanggan_fails_with_invalid_data(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.update'), [
                'pelanggan_id' => $pelanggan->pelanggan_id,
                'first_name' => '',
                'last_name' => '',
                'birthday' => '2030-01-01',
                'gender' => 'Invalid',
                'email' => 'not-email',
                'phone' => '',
            ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function test_update_pelanggan_allows_keeping_same_email(): void
    {
        $pelanggan = Pelanggan::factory()->create(['email' => 'same@example.com']);

        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.update'), [
                'pelanggan_id' => $pelanggan->pelanggan_id,
                'first_name' => 'Updated',
                'last_name' => 'Name',
                'birthday' => '1990-05-15',
                'gender' => 'Male',
                'email' => 'same@example.com',
                'phone' => '081234567890',
            ]);

        $response->assertRedirect(route('pelanggan.list'));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function test_update_pelanggan_fails_with_nonexistent_id(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('pelanggan.update'), [
                'pelanggan_id' => 99999,
                'first_name' => 'Test',
                'last_name' => 'User',
                'birthday' => '1990-05-15',
                'gender' => 'Male',
                'email' => 'test@example.com',
                'phone' => '081234567890',
            ]);

        $response->assertSessionHasErrors('pelanggan_id');
    }

    // ========== DESTROY ==========

    /** @test */
    public function test_can_delete_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('pelanggan.destroy', $pelanggan->pelanggan_id));

        $response->assertRedirect(route('pelanggan.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('pelanggan', ['pelanggan_id' => $pelanggan->pelanggan_id]);
    }

    /** @test */
    public function test_delete_nonexistent_pelanggan_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('pelanggan.destroy', 99999));

        $response->assertStatus(404);
    }
}
