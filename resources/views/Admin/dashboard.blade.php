@extends('layouts.admin.app')

@section('content')
<div class="row mt-4">

    {{-- ===== 4 STAT CARDS ===== --}}
    <div class="col-12 mb-4">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;background:#fff3cd;">
                            <svg width="26" height="26" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Total mitra</p>
                            <h4 class="mb-0 fw-bold">{{ $mitra }}</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-2 text-end">
                        <a href="{{ route('mitra.list') }}" class="small text-primary">Lihat semua &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;background:#d1fae5;">
                            <svg width="26" height="26" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Total pelanggan</p>
                            <h4 class="mb-0 fw-bold">{{ $pelanggan }}</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-2 text-end">
                        <a href="{{ route('pelanggan.list') }}" class="small text-primary">Lihat semua &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;background:#dbeafe;">
                            <svg width="26" height="26" fill="none" stroke="#3b82f6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Total produk</p>
                            <h4 class="mb-0 fw-bold">{{ $Totalproduk }}</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-2 text-end">
                        <a href="{{ route('produk.list') }}" class="small text-primary">Lihat semua &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;background:#fce7f3;">
                            <svg width="26" height="26" fill="none" stroke="#ec4899" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Total pesanan</p>
                            <h4 class="mb-0 fw-bold">{{ $pesan }}</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-2 text-end">
                        <a href="{{ route('pesan.list') }}" class="small text-primary">Lihat semua &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== KOLOM UTAMA (KIRI) ===== --}}
    <div class="col-12 col-xl-8">

        {{-- TABEL PESANAN TERBARU --}}
        <div class="card border-0 shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">🥟 pesanan Terbaru</h2>
                <a href="{{ route('pesan.list') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis produk</th>
                                <th>Varian</th>
                                <th>Jumlah</th>
                                <th>Tgl Ambil</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanTerbaru as $i => $p)
                            <tr>
                                <td class="ps-3">{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $p->nama_pemesan }}</td>
                                <td>{{ $p->jenis_produk }}</td>
                                <td>{{ $p->varian_produk }}</td>
                                <td>{{ $p->jumlah_pesanan }} pcs</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_pengambilan)->format('d M Y') }}</td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($p->status == 'confirmed')
                                        <span class="badge bg-info">Dikonfirmasi</span>
                                    @elseif($p->status == 'processing')
                                        <span class="badge bg-primary">Diproses</span>
                                    @elseif($p->status == 'ready')
                                        <span class="badge bg-success">Siap</span>
                                    @elseif($p->status == 'completed')
                                        <span class="badge bg-secondary">Selesai</span>
                                    @elseif($p->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-light text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pesan.edit', $p->pesanan_id) }}" class="btn btn-info btn-sm py-0 px-2 me-1">Edit</a>
                                    <a href="{{ route('pesan.destroy', $p->pesanan_id) }}" class="btn btn-danger btn-sm py-0 px-2"
                                        onclick="return confirm('Hapus pesanan ini?')">Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada pesanan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- GRAFIK JUMLAH PRODUK --}}
        <div class="card border-0 shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">📦 Grafik Jumlah produk</h2>
                <a href="{{ route('produk.list') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <canvas id="produkChart" style="max-height:280px;"></canvas>
            </div>
        </div>

        {{-- GRAFIK TANGGAL MASUK VS EXPIRED --}}
        <div class="card border-0 shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">📅 Grafik Tgl Masuk vs Expired produk</h2>
                <a href="{{ route('produk.list') }}" class="btn btn-sm btn-outline-secondary">Detail</a>
            </div>
            <div class="card-body">
                <canvas id="horizontalBarChart" style="max-height:260px;"></canvas>
            </div>
        </div>

    </div>

    {{-- ===== SIDEBAR KANAN ===== --}}
    <div class="col-12 col-xl-4">

        {{-- Profil Card --}}
        <div class="card border-0 shadow mb-4 text-center">
            <div class="card-body pt-4 pb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::check() ? Auth::user()->name : 'User') }}&background=ff8800&color=fff&size=128&rounded=true"
                    class="rounded-circle mb-3" width="80" height="80" alt="Avatar">
                <h5 class="mb-0 fw-bold">{{ Auth::check() ? Auth::user()->name : '-' }}</h5>
                <p class="text-muted small mb-1">{{ Auth::check() ? Auth::user()->role : '' }}</p>
                <p class="text-muted small mb-3">{{ Auth::check() ? Auth::user()->email : '' }}</p>
                <a href="{{ route('admin.list') }}" class="btn btn-sm btn-warning text-white w-100">Kelola User</a>
            </div>
        </div>

        {{-- Ringkasan pesanan --}}
        <div class="card border-0 shadow mb-4">
            <div class="card-header">
                <h2 class="fs-5 fw-bold mb-0">📋 Ringkasan pesanan</h2>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($pesanTerbaru as $p)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-0 fw-semibold small">{{ $p->nama_pemesan }}</p>
                            <span class="text-muted" style="font-size:0.78rem;">{{ $p->varian_produk }} ({{ $p->jumlah_pesanan }} pcs)</span>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill mt-1">
                            {{ \Carbon\Carbon::parse($p->tanggal_pengambilan)->format('d M') }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center small py-3">Belum ada pesanan</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer text-end bg-transparent">
                <a href="{{ route('pesan.list') }}" class="small text-primary">Lihat semua pesanan &rarr;</a>
            </div>
        </div>

        {{-- Menu Cepat --}}
        <div class="card border-0 shadow mb-4">
            <div class="card-header">
                <h2 class="fs-5 fw-bold mb-0">⚡ Menu Cepat</h2>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('pesan.list') }}" class="btn btn-sm text-start" style="color:#fff;background:#ec4899;border-color:#ec4899;">
                    🥟 Kelola pesanan
                </a>
                <a href="{{ route('mitra.list') }}" class="btn btn-outline-warning btn-sm text-start">
                    🤝 Kelola mitra
                </a>
                <a href="{{ route('produk.list') }}" class="btn btn-outline-primary btn-sm text-start">
                    📦 Kelola produk
                </a>
                <a href="{{ route('pelanggan.list') }}" class="btn btn-outline-success btn-sm text-start">
                    👤 Kelola pelanggan
                </a>
                @if(Auth::check() && Auth::user()->role == 'administrator')
                <a href="{{ route('admin.list') }}" class="btn btn-outline-secondary btn-sm text-start">
                    🔒 Kelola admin
                </a>
                @endif
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Jumlah produk
    const ctx1 = document.getElementById('produkChart')?.getContext('2d');
    if(ctx1) {
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels ?? []) !!},
                datasets: [{
                    label: 'Jumlah Stok',
                    data: {!! json_encode($data ?? []) !!},
                    backgroundColor: 'rgba(251, 146, 60, 0.6)',
                    borderColor: 'rgba(251, 146, 60, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    }

    // Chart Tanggal Masuk vs Expired
    const ctx2 = document.getElementById('horizontalBarChart')?.getContext('2d');
    if(ctx2) {
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels ?? []) !!},
                datasets: [
                    {
                        label: 'Tanggal Masuk',
                        data: {!! json_encode($tglMasuk ?? []) !!},
                        backgroundColor: 'rgba(52, 211, 153, 0.7)',
                        borderColor: 'rgba(52, 211, 153, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Tanggal Expired',
                        data: {!! json_encode($tglExpired ?? []) !!},
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1,
                    }
                ],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: { legend: { position: 'top' } },
            },
        });
    }
});
</script>

@endsection