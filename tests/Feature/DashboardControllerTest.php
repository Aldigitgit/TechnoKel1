<?php

namespace Tests\Feature;

use App\Models\Mitra;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
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

    /** @test */
    public function test_unauthenticated_user_cannot_access_dashboard(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /** @test */
    public function test_dashboard_has_required_view_data(): void
    {
        // Seed some data
        Produk::factory()->count(3)->create();
        Mitra::factory()->count(2)->create();
        User::factory()->count(3)->create(['role' => 'Pelanggan']);
        Pesan::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'mitra',
            'pelanggan',
            'admin',
            'pesan',
            'Totalproduk',
            'pesanTerbaru',
            'labels',
            'data',
            'tglMasuk',
            'tglExpired',
        ]);
    }

    /** @test */
    public function test_dashboard_counts_are_correct(): void
    {
        Mitra::factory()->count(3)->create();
        User::factory()->count(4)->create(['role' => 'Pelanggan']);
        User::factory()->count(2)->create(['role' => 'administrator']);
        Produk::factory()->count(5)->create();
        Pesan::factory()->count(6)->create();

        $response = $this->actingAs($this->admin)->get(route('dashboard'));

        $response->assertViewHas('mitra', 3);
        $response->assertViewHas('pelanggan', 4);
        // admin count includes the setUp admin + 2 created = 3
        $response->assertViewHas('admin', 3);
        $response->assertViewHas('Totalproduk', 5);
        $response->assertViewHas('pesan', 6);
    }

    /** @test */
    public function test_dashboard_shows_latest_5_orders(): void
    {
        Pesan::factory()->count(10)->create();

        $response = $this->actingAs($this->admin)->get(route('dashboard'));

        $pesanTerbaru = $response->viewData('pesanTerbaru');
        $this->assertCount(5, $pesanTerbaru);
    }

    /** @test */
    public function test_dashboard_works_with_empty_data(): void
    {
        $response = $this->actingAs($this->admin)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('mitra', 0);
        $response->assertViewHas('Totalproduk', 0);
        $response->assertViewHas('pesan', 0);
    }
}
