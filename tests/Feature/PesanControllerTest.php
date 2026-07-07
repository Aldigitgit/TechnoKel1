<?php

namespace Tests\Feature;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PesanControllerTest extends TestCase
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

    // ========== INDEX ==========

    /** @test */
    public function test_can_view_pesan_list(): void
    {
        Pesan::factory()->count(5)->create();

        $response = $this->get(route('pesan.list'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.index');
        $response->assertViewHas('datapesan');
    }

    /** @test */
    public function test_pesan_list_is_paginated(): void
    {
        Pesan::factory()->count(15)->create();

        $response = $this->get(route('pesan.list'));

        $datapesan = $response->viewData('datapesan');
        $this->assertEquals(10, $datapesan->perPage());
        $this->assertEquals(15, $datapesan->total());
    }

    /** @test */
    public function test_pesan_list_shows_latest_first(): void
    {
        $oldest = Pesan::factory()->create(['created_at' => now()->subDays(5)]);
        $newest = Pesan::factory()->create(['created_at' => now()]);

        $response = $this->get(route('pesan.list'));

        $datapesan = $response->viewData('datapesan');
        $this->assertEquals($newest->pesanan_id, $datapesan->first()->pesanan_id);
    }

    // ========== CREATE ==========

    /** @test */
    public function test_can_view_create_pesan_form(): void
    {
        $response = $this->get(route('pesan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.create');
    }

    // ========== STORE ==========

    /** @test */
    public function test_can_store_new_pesan(): void
    {
        $data = [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'John Doe',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'john@example.com',
        ];

        $response = $this->post(route('pesan.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pesanans', [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'nama_pemesan' => 'John Doe',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function test_store_pesan_calculates_total_harga_correctly(): void
    {
        $data = [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Keju',  // 6000
            'jumlah_pesanan' => 10,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
        ];

        $this->post(route('pesan.store'), $data);

        $pesan = Pesan::latest()->first();
        $this->assertEquals(60000, $pesan->total_harga);  // 6000 * 10
    }

    /** @test */
    public function test_store_pesan_with_unknown_varian_has_zero_total(): void
    {
        $data = [
            'jenis_produk' => 'Custom',
            'varian_produk' => 'Produk Tidak Dikenal',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
        ];

        $this->post(route('pesan.store'), $data);

        $pesan = Pesan::latest()->first();
        $this->assertEquals(0, $pesan->total_harga);
    }

    /** @test */
    public function test_store_pesan_with_bukti_pembayaran(): void
    {
        Storage::fake('public');

        $data = [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 3,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
            'metode_pembayaran' => 'transfer',
            'nominal_dp' => 15000,
        ];

        $response = $this->post(route('pesan.store'), $data);

        $response->assertRedirect();

        $pesan = Pesan::latest()->first();
        $this->assertNotNull($pesan->bukti_pembayaran);
        Storage::disk('public')->assertExists('uploads/' . $pesan->bukti_pembayaran);
    }

    /** @test */
    public function test_store_pesan_with_ambil_di_toko(): void
    {
        $data = [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 2,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
            'ambil_di_toko' => true,
        ];

        $this->post(route('pesan.store'), $data);

        $pesan = Pesan::latest()->first();
        $this->assertTrue((bool) $pesan->ambil_di_toko);
    }

    /** @test */
    public function test_store_pesan_fails_without_required_fields(): void
    {
        $response = $this->post(route('pesan.store'), []);

        $response->assertSessionHasErrors([
            'jenis_produk', 'varian_produk', 'jumlah_pesanan',
            'tanggal_pengambilan', 'nama_pemesan', 'kontak_pemesan', 'email_pemesan',
        ]);
    }

    /** @test */
    public function test_store_pesan_fails_with_past_date(): void
    {
        $response = $this->post(route('pesan.store'), [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->subDays(1)->format('Y-m-d H:i:s'),  // Past date
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('tanggal_pengambilan');
    }

    /** @test */
    public function test_store_pesan_fails_with_zero_jumlah(): void
    {
        $response = $this->post(route('pesan.store'), [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 0,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('jumlah_pesanan');
    }

    /** @test */
    public function test_store_pesan_fails_with_invalid_email(): void
    {
        $response = $this->post(route('pesan.store'), [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'not-a-valid-email',
        ]);

        $response->assertSessionHasErrors('email_pemesan');
    }

    /** @test */
    public function test_store_pesan_fails_with_invalid_bukti_pembayaran(): void
    {
        $response = $this->post(route('pesan.store'), [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
            'bukti_pembayaran' => UploadedFile::fake()->create('document.pdf', 100),
        ]);

        $response->assertSessionHasErrors('bukti_pembayaran');
    }

    /** @test */
    public function test_store_pesan_sets_status_to_pending(): void
    {
        $data = [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Coklat Lumer',
            'jumlah_pesanan' => 5,
            'tanggal_pengambilan' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Test User',
            'kontak_pemesan' => '081234567890',
            'email_pemesan' => 'test@example.com',
        ];

        $this->post(route('pesan.store'), $data);

        $pesan = Pesan::latest()->first();
        $this->assertEquals('pending', $pesan->status);
    }

    // ========== SUCCESS ==========

    /** @test */
    public function test_can_view_success_page(): void
    {
        $pesan = Pesan::factory()->create();

        $response = $this->get(route('pesan.success', $pesan->pesanan_id));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.success');
        $response->assertViewHas('pesanan');
    }

    /** @test */
    public function test_success_page_returns_404_for_nonexistent_order(): void
    {
        $response = $this->get(route('pesan.success', 99999));

        $response->assertStatus(404);
    }

    // ========== SHOW ==========

    /** @test */
    public function test_can_view_pesan_detail(): void
    {
        $pesan = Pesan::factory()->create();

        $response = $this->get(route('pesan.show', $pesan->pesanan_id));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.show');
        $response->assertViewHas('pesanan');
    }

    /** @test */
    public function test_show_nonexistent_pesan_returns_404(): void
    {
        $response = $this->get(route('pesan.show', 99999));

        $response->assertStatus(404);
    }

    // ========== EDIT ==========

    /** @test */
    public function test_can_view_edit_pesan_form(): void
    {
        $pesan = Pesan::factory()->create();

        $response = $this->get(route('pesan.edit', $pesan->pesanan_id));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.edit');
        $response->assertViewHas('datapesan');
    }

    // ========== UPDATE ==========

    /** @test */
    public function test_can_update_pesan(): void
    {
        $pesan = Pesan::factory()->create([
            'nama_pemesan' => 'Old Name',
            'jumlah_pesanan' => 5,
        ]);

        $response = $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => 'Bakpao Keju',
            'jumlah_pesanan' => 10,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => 'Updated Name',
            'kontak_pemesan' => '089876543210',
            'email_pemesan' => 'updated@example.com',
        ]);

        $response->assertRedirect(route('pesan.list'));
        $response->assertSessionHas('success');

        $pesan->refresh();
        $this->assertEquals('Updated Name', $pesan->nama_pemesan);
        $this->assertEquals(10, $pesan->jumlah_pesanan);
        $this->assertEquals(60000, $pesan->total_harga); // 6000 * 10
    }

    /** @test */
    public function test_update_pesan_can_change_status(): void
    {
        $pesan = Pesan::factory()->create(['status' => 'pending']);

        $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => $pesan->jenis_produk,
            'varian_produk' => $pesan->varian_produk,
            'jumlah_pesanan' => $pesan->jumlah_pesanan,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => $pesan->nama_pemesan,
            'kontak_pemesan' => $pesan->kontak_pemesan,
            'email_pemesan' => $pesan->email_pemesan,
            'status' => 'confirmed',
        ]);

        $pesan->refresh();
        $this->assertEquals('confirmed', $pesan->status);
    }

    /** @test */
    public function test_update_pesan_with_new_bukti_pembayaran(): void
    {
        Storage::fake('public');

        $pesan = Pesan::factory()->create();

        $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => $pesan->jenis_produk,
            'varian_produk' => $pesan->varian_produk,
            'jumlah_pesanan' => $pesan->jumlah_pesanan,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => $pesan->nama_pemesan,
            'kontak_pemesan' => $pesan->kontak_pemesan,
            'email_pemesan' => $pesan->email_pemesan,
            'bukti_pembayaran' => UploadedFile::fake()->image('new_bukti.jpg'),
        ]);

        $pesan->refresh();
        $this->assertNotNull($pesan->bukti_pembayaran);
        Storage::disk('public')->assertExists('uploads/' . $pesan->bukti_pembayaran);
    }

    /** @test */
    public function test_update_pesan_fails_with_invalid_status(): void
    {
        $pesan = Pesan::factory()->create();

        $response = $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => $pesan->jenis_produk,
            'varian_produk' => $pesan->varian_produk,
            'jumlah_pesanan' => $pesan->jumlah_pesanan,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => $pesan->nama_pemesan,
            'kontak_pemesan' => $pesan->kontak_pemesan,
            'email_pemesan' => $pesan->email_pemesan,
            'status' => 'invalid_status',
        ]);

        $response->assertSessionHasErrors('status');
    }

    /** @test */
    public function test_update_pesan_recalculates_total_harga(): void
    {
        $pesan = Pesan::factory()->create([
            'varian_produk' => 'Bakpao Kacang Merah', // 5000
            'jumlah_pesanan' => 5,
            'total_harga' => 25000,
        ]);

        $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => 'Dimsum',
            'varian_produk' => 'Dimsum Ayam',  // 6000
            'jumlah_pesanan' => 8,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => $pesan->nama_pemesan,
            'kontak_pemesan' => $pesan->kontak_pemesan,
            'email_pemesan' => $pesan->email_pemesan,
        ]);

        $pesan->refresh();
        $this->assertEquals(48000, $pesan->total_harga); // 6000 * 8
    }

    // ========== DESTROY ==========

    /** @test */
    public function test_can_delete_pesan(): void
    {
        $pesan = Pesan::factory()->create();

        $response = $this->delete(route('pesan.destroy', $pesan->pesanan_id));

        $response->assertRedirect(route('pesan.list'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('pesanans', ['pesanan_id' => $pesan->pesanan_id]);
    }

    /** @test */
    public function test_delete_pesan_removes_bukti_pembayaran_file(): void
    {
        Storage::fake('public');

        // Create a fake file
        $filename = 'test_bukti.jpg';
        Storage::disk('public')->put('uploads/' . $filename, 'fake content');

        $pesan = Pesan::factory()->create(['bukti_pembayaran' => $filename]);

        $this->delete(route('pesan.destroy', $pesan->pesanan_id));

        Storage::disk('public')->assertMissing('uploads/' . $filename);
    }

    /** @test */
    public function test_delete_nonexistent_pesan_returns_404(): void
    {
        $response = $this->delete(route('pesan.destroy', 99999));

        $response->assertStatus(404);
    }

    // ========== UPDATE STATUS ==========

    /** @test */
    public function test_can_update_pesan_status_to_confirmed(): void
    {
        $pesan = Pesan::factory()->create(['status' => 'pending']);

        $response = $this->post(route('pesan.update'), [
            'pesanan_id' => $pesan->pesanan_id,
            'jenis_produk' => $pesan->jenis_produk,
            'varian_produk' => $pesan->varian_produk,
            'jumlah_pesanan' => $pesan->jumlah_pesanan,
            'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'nama_pemesan' => $pesan->nama_pemesan,
            'kontak_pemesan' => $pesan->kontak_pemesan,
            'email_pemesan' => $pesan->email_pemesan,
            'status' => 'confirmed',
        ]);

        $response->assertRedirect(route('pesan.list'));
        $pesan->refresh();
        $this->assertEquals('confirmed', $pesan->status);
    }

    /** @test */
    public function test_can_update_pesan_status_through_all_valid_statuses(): void
    {
        $validStatuses = ['pending', 'confirmed', 'processing', 'ready', 'completed', 'cancelled'];

        foreach ($validStatuses as $status) {
            $pesan = Pesan::factory()->create(['status' => 'pending']);

            $response = $this->post(route('pesan.update'), [
                'pesanan_id' => $pesan->pesanan_id,
                'jenis_produk' => $pesan->jenis_produk,
                'varian_produk' => $pesan->varian_produk,
                'jumlah_pesanan' => $pesan->jumlah_pesanan,
                'tanggal_pengambilan' => now()->addDays(5)->format('Y-m-d H:i:s'),
                'nama_pemesan' => $pesan->nama_pemesan,
                'kontak_pemesan' => $pesan->kontak_pemesan,
                'email_pemesan' => $pesan->email_pemesan,
                'status' => $status,
            ]);

            $response->assertRedirect(route('pesan.list'));
            $pesan->refresh();
            $this->assertEquals($status, $pesan->status);
        }
    }
}
