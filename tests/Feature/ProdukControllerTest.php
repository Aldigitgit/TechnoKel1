<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdukControllerTest extends TestCase
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
    public function test_unauthenticated_user_cannot_access_produk_pages(): void
    {
        $response = $this->get(route('produk.list'));
        $response->assertRedirect(route('login'));
    }

    // ========== INDEX ==========

    /** @test */
    public function test_can_view_produk_list(): void
    {
        Produk::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get(route('produk.list'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.produk.index');
        $response->assertViewHas('dataproduk');
    }

    /** @test */
    public function test_produk_list_can_filter_by_kategori(): void
    {
        Produk::factory()->count(3)->create(['kategori' => 'Bakpao Manis']);
        Produk::factory()->count(2)->create(['kategori' => 'Dimsum Goreng']);

        $response = $this->actingAs($this->admin)
            ->get(route('produk.list', ['kategori' => 'Bakpao Manis']));

        $response->assertStatus(200);
        $dataproduk = $response->viewData('dataproduk');
        foreach ($dataproduk as $produk) {
            $this->assertEquals('Bakpao Manis', $produk->kategori);
        }
    }

    /** @test */
    public function test_produk_list_can_search_by_name(): void
    {
        Produk::factory()->create(['nama_produk' => 'Bakpao Coklat Premium']);
        Produk::factory()->create(['nama_produk' => 'Dimsum Udang']);

        $response = $this->actingAs($this->admin)
            ->get(route('produk.list', ['search' => 'Bakpao Coklat']));

        $response->assertStatus(200);
        $dataproduk = $response->viewData('dataproduk');
        $this->assertEquals(1, $dataproduk->total());
    }

    /** @test */
    public function test_produk_list_is_paginated(): void
    {
        Produk::factory()->count(15)->create();

        $response = $this->actingAs($this->admin)->get(route('produk.list'));

        $dataproduk = $response->viewData('dataproduk');
        $this->assertEquals(10, $dataproduk->perPage());
        $this->assertEquals(15, $dataproduk->total());
    }

    /** @test */
    public function test_produk_list_with_empty_data(): void
    {
        $response = $this->actingAs($this->admin)->get(route('produk.list'));

        $response->assertStatus(200);
        $dataproduk = $response->viewData('dataproduk');
        $this->assertEquals(0, $dataproduk->total());
    }

    // ========== CREATE ==========

    /** @test */
    public function test_can_view_create_produk_form(): void
    {
        $response = $this->actingAs($this->admin)->get(route('produk.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.produk.create');
    }

    // ========== STORE ==========

    /** @test */
    public function test_can_store_new_produk(): void
    {
        $data = [
            'nama_produk' => 'Bakpao Coklat',
            'jumlah' => 50,
            'kategori' => 'Bakpao Manis',
            'harga' => 5000,
            'tgl_masuk' => '2024-01-15',
            'tgl_expired' => '2024-06-15',
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), $data);

        $response->assertRedirect(route('produk.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('produk', [
            'nama_produk' => 'Bakpao Coklat',
            'jumlah' => 50,
            'harga' => 5000,
        ]);
    }

    /** @test */
    public function test_store_produk_fails_without_required_fields(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), []);

        $response->assertSessionHasErrors([
            'nama_produk', 'jumlah', 'kategori', 'harga', 'tgl_masuk', 'tgl_expired',
        ]);
    }

    /** @test */
    public function test_store_produk_fails_with_invalid_kategori(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), [
                'nama_produk' => 'Test Produk',
                'jumlah' => 10,
                'kategori' => 'Kategori Invalid',
                'harga' => 5000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertSessionHasErrors('kategori');
    }

    /** @test */
    public function test_store_produk_fails_when_expired_before_masuk(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), [
                'nama_produk' => 'Test Produk',
                'jumlah' => 10,
                'kategori' => 'Bakpao Manis',
                'harga' => 5000,
                'tgl_masuk' => '2024-06-15',
                'tgl_expired' => '2024-01-15', // Before tgl_masuk
            ]);

        $response->assertSessionHasErrors('tgl_expired');
    }

    /** @test */
    public function test_store_produk_fails_with_duplicate_name(): void
    {
        Produk::factory()->create(['nama_produk' => 'Existing Product']);

        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), [
                'nama_produk' => 'Existing Product',
                'jumlah' => 10,
                'kategori' => 'Bakpao Manis',
                'harga' => 5000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertSessionHasErrors('nama_produk');
    }

    /** @test */
    public function test_store_produk_fails_with_negative_jumlah(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), [
                'nama_produk' => 'Test Produk',
                'jumlah' => -5,
                'kategori' => 'Bakpao Manis',
                'harga' => 5000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertSessionHasErrors('jumlah');
    }

    /** @test */
    public function test_store_produk_fails_with_negative_harga(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.store'), [
                'nama_produk' => 'Test Produk',
                'jumlah' => 10,
                'kategori' => 'Bakpao Manis',
                'harga' => -1000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertSessionHasErrors('harga');
    }

    /** @test */
    public function test_can_store_produk_with_all_valid_categories(): void
    {
        $categories = ['Bakpao Manis', 'Bakpao Gurih', 'Bakpao Spesial', 'Dimsum Goreng', 'Risol Mayo'];

        foreach ($categories as $index => $kategori) {
            $response = $this->actingAs($this->admin)
                ->post(route('produk.store'), [
                    'nama_produk' => "Produk {$kategori} {$index}",
                    'jumlah' => 10,
                    'kategori' => $kategori,
                    'harga' => 5000,
                    'tgl_masuk' => '2024-01-15',
                    'tgl_expired' => '2024-06-15',
                ]);

            $response->assertRedirect(route('produk.list'));
        }

        $this->assertEquals(5, Produk::count());
    }

    // ========== EDIT ==========

    /** @test */
    public function test_can_view_edit_produk_form(): void
    {
        $produk = Produk::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('produk.edit', $produk->produk_id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.produk.edit');
        $response->assertViewHas('dataproduk');
    }

    /** @test */
    public function test_edit_nonexistent_produk_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('produk.edit', 99999));

        $response->assertStatus(404);
    }

    // ========== UPDATE ==========

    /** @test */
    public function test_can_update_produk(): void
    {
        $produk = Produk::factory()->create([
            'nama_produk' => 'Old Name',
            'jumlah' => 10,
            'harga' => 5000,
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('produk.update'), [
                'produk_id' => $produk->produk_id,
                'nama_produk' => 'Updated Name',
                'jumlah' => 25,
                'kategori' => 'Dimsum Goreng',
                'harga' => 7000,
                'tgl_masuk' => '2024-02-01',
                'tgl_expired' => '2024-08-01',
            ]);

        $response->assertRedirect(route('produk.list'));
        $response->assertSessionHas('success');

        $produk->refresh();
        $this->assertEquals('Updated Name', $produk->nama_produk);
        $this->assertEquals(25, $produk->jumlah);
        $this->assertEquals(7000, $produk->harga);
        $this->assertEquals('Dimsum Goreng', $produk->kategori);
    }

    /** @test */
    public function test_update_produk_fails_with_invalid_data(): void
    {
        $produk = Produk::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post(route('produk.update'), [
                'produk_id' => $produk->produk_id,
                'nama_produk' => '',
                'jumlah' => -1,
                'kategori' => 'Invalid',
                'harga' => -100,
                'tgl_masuk' => '2024-06-15',
                'tgl_expired' => '2024-01-15',
            ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function test_update_produk_allows_keeping_same_name(): void
    {
        $produk = Produk::factory()->create(['nama_produk' => 'Same Name']);

        $response = $this->actingAs($this->admin)
            ->post(route('produk.update'), [
                'produk_id' => $produk->produk_id,
                'nama_produk' => 'Same Name',
                'jumlah' => 20,
                'kategori' => 'Bakpao Manis',
                'harga' => 6000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertRedirect(route('produk.list'));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function test_update_nonexistent_produk_fails(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('produk.update'), [
                'produk_id' => 99999,
                'nama_produk' => 'Test',
                'jumlah' => 10,
                'kategori' => 'Bakpao Manis',
                'harga' => 5000,
                'tgl_masuk' => '2024-01-15',
                'tgl_expired' => '2024-06-15',
            ]);

        $response->assertSessionHasErrors('produk_id');
    }

    // ========== DESTROY ==========

    /** @test */
    public function test_can_delete_produk(): void
    {
        $produk = Produk::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('produk.destroy', $produk->produk_id));

        $response->assertRedirect(route('produk.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('produk', ['produk_id' => $produk->produk_id]);
    }

    /** @test */
    public function test_delete_nonexistent_produk_returns_404(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('produk.destroy', 99999));

        $response->assertStatus(404);
    }
}
