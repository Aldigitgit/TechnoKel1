<?php

namespace Tests\Feature;

use App\Models\Mitra;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MitraControllerTest extends TestCase
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
    public function test_unauthenticated_user_cannot_access_mitra_pages(): void
    {
        $response = $this->get(route('mitra.list'));
        $response->assertRedirect(route('login'));
    }

    // ========== INDEX ==========

    /** @test */
    public function test_can_view_mitra_list(): void
    {
        Mitra::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get(route('mitra.list'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.mitra.index');
        $response->assertViewHas('datamitra');
    }

    /** @test */
    public function test_mitra_list_can_filter_by_kemitraan(): void
    {
        Mitra::factory()->count(3)->create(['kemitraan' => 'Platinum']);
        Mitra::factory()->count(2)->create(['kemitraan' => 'Gold']);

        $response = $this->actingAs($this->admin)
            ->get(route('mitra.list', ['Kemitraan' => 'Platinum']));

        $response->assertStatus(200);
        $datamitra = $response->viewData('datamitra');
        foreach ($datamitra as $mitra) {
            $this->assertEquals('Platinum', $mitra->kemitraan);
        }
    }

    /** @test */
    public function test_mitra_list_can_filter_by_tahun(): void
    {
        Mitra::factory()->create(['bergabung' => '2024-06-15']);
        Mitra::factory()->create(['bergabung' => '2023-03-10']);

        $response = $this->actingAs($this->admin)
            ->get(route('mitra.list', ['tahun' => '2024']));

        $response->assertStatus(200);
        $datamitra = $response->viewData('datamitra');
        foreach ($datamitra as $mitra) {
            $this->assertEquals(2024, date('Y', strtotime($mitra->bergabung)));
        }
    }

    /** @test */
    public function test_mitra_list_can_search(): void
    {
        Mitra::factory()->create(['nama_mitra' => 'Toko Bakpao Jaya']);
        Mitra::factory()->create(['nama_mitra' => 'Warung Makan Sederhana']);

        $response = $this->actingAs($this->admin)
            ->get(route('mitra.list', ['search' => 'Bakpao']));

        $response->assertStatus(200);
        $datamitra = $response->viewData('datamitra');
        $this->assertEquals(1, $datamitra->total());
    }

    /** @test */
    public function test_mitra_list_is_paginated(): void
    {
        Mitra::factory()->count(15)->create();

        $response = $this->actingAs($this->admin)->get(route('mitra.list'));

        $datamitra = $response->viewData('datamitra');
        $this->assertEquals(10, $datamitra->perPage());
        $this->assertEquals(15, $datamitra->total());
    }

    // ========== CREATE ==========

    /** @test */
    public function test_can_view_create_mitra_form(): void
    {
        $response = $this->actingAs($this->admin)->get(route('mitra.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.mitra.create');
    }

    // ========== STORE ==========

    /** @test */
    public function test_can_store_new_mitra(): void
    {
        $mitraData = [
            'Nama_mitra' => 'Toko Baru',
            'Alamat' => 'Jl. Contoh No. 1',
            'Email' => 'tokobaru@example.com',
            'Nomor_Telepon' => '081234567890',
            'Kemitraan' => 'Gold',
            'Bergabung' => '2024-01-15',
            'confirmation' => true,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('mitra.store'), $mitraData);

        $response->assertRedirect(route('mitra.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('mitra', [
            'nama_mitra' => 'Toko Baru',
            'email' => 'tokobaru@example.com',
            'kemitraan' => 'Gold',
        ]);
    }

    /** @test */
    public function test_store_mitra_fails_without_required_fields(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('mitra.store'), []);

        $response->assertSessionHasErrors([
            'Nama_mitra', 'Alamat', 'Email', 'Nomor_Telepon', 'Kemitraan', 'Bergabung', 'confirmation',
        ]);
    }

    /** @test */
    public function test_store_mitra_fails_with_invalid_kemitraan(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('mitra.store'), [
                'Nama_mitra' => 'Test',
                'Alamat' => 'Test Address',
                'Email' => 'test@example.com',
                'Nomor_Telepon' => '081234567890',
                'Kemitraan' => 'Bronze', // Invalid
                'Bergabung' => '2024-01-15',
                'confirmation' => true,
            ]);

        $response->assertSessionHasErrors('Kemitraan');
    }

    /** @test */
    public function test_store_mitra_fails_with_duplicate_email(): void
    {
        Mitra::factory()->create(['email' => 'existing@example.com']);

        $response = $this->actingAs($this->admin)
            ->post(route('mitra.store'), [
                'Nama_mitra' => 'Test',
                'Alamat' => 'Test Address',
                'Email' => 'existing@example.com',
                'Nomor_Telepon' => '081234567890',
                'Kemitraan' => 'Gold',
                'Bergabung' => '2024-01-15',
                'confirmation' => true,
            ]);

        $response->assertSessionHasErrors('Email');
    }

    /** @test */
    public function test_store_mitra_fails_without_confirmation(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('mitra.store'), [
                'Nama_mitra' => 'Test',
                'Alamat' => 'Test Address',
                'Email' => 'test@example.com',
                'Nomor_Telepon' => '081234567890',
                'Kemitraan' => 'Gold',
                'Bergabung' => '2024-01-15',
            ]);

        $response->assertSessionHasErrors('confirmation');
    }

    // ========== SHOW ==========

    /** @test */
    public function test_can_view_mitra_detail(): void
    {
        $mitra = Mitra::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('mitra.edit', $mitra->mitra_id));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_show_nonexistent_mitra_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('mitra.edit', 99999));

        $response->assertStatus(404);
    }

    // ========== EDIT ==========

    /** @test */
    public function test_can_view_edit_mitra_form(): void
    {
        $mitra = Mitra::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('mitra.edit', $mitra->mitra_id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.mitra.edit');
        $response->assertViewHas('datamitra');
    }

    // ========== UPDATE ==========

    /** @test */
    public function test_can_update_mitra(): void
    {
        $mitra = Mitra::factory()->create([
            'nama_mitra' => 'Old Name',
            'kemitraan' => 'Silver',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('mitra.update'), [
                'mitra_id' => $mitra->mitra_id,
                'Nama_mitra' => 'Updated Name',
                'Alamat' => 'New Address',
                'Email' => $mitra->email,
                'Nomor_Telepon' => '089876543210',
                'Kemitraan' => 'Platinum',
                'Bergabung' => '2024-06-01',
            ]);

        $response->assertRedirect(route('mitra.list'));
        $response->assertSessionHas('success');

        $mitra->refresh();
        $this->assertEquals('Updated Name', $mitra->nama_mitra);
        $this->assertEquals('Platinum', $mitra->kemitraan);
    }

    /** @test */
    public function test_update_mitra_fails_with_invalid_data(): void
    {
        $mitra = Mitra::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post(route('mitra.update'), [
                'mitra_id' => $mitra->mitra_id,
                'Nama_mitra' => '',
                'Alamat' => '',
                'Email' => 'not-email',
                'Nomor_Telepon' => '',
                'Kemitraan' => 'Invalid',
                'Bergabung' => 'not-a-date',
            ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function test_update_mitra_allows_same_email(): void
    {
        $mitra = Mitra::factory()->create(['email' => 'same@example.com']);

        $response = $this->actingAs($this->admin)
            ->post(route('mitra.update'), [
                'mitra_id' => $mitra->mitra_id,
                'Nama_mitra' => 'Updated',
                'Alamat' => 'New Address',
                'Email' => 'same@example.com',
                'Nomor_Telepon' => '081234567890',
                'Kemitraan' => 'Gold',
                'Bergabung' => '2024-01-15',
            ]);

        $response->assertRedirect(route('mitra.list'));
        $response->assertSessionHas('success');
    }

    // ========== DESTROY ==========

    /** @test */
    public function test_can_delete_mitra(): void
    {
        $mitra = Mitra::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('mitra.destroy', $mitra->mitra_id));

        $response->assertRedirect(route('mitra.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('mitra', ['mitra_id' => $mitra->mitra_id]);
    }

    /** @test */
    public function test_delete_nonexistent_mitra_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('mitra.destroy', 99999));

        $response->assertStatus(404);
    }
}
