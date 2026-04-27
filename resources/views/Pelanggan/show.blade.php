@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pesan.list') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active">Detail Pesanan</li>
                </ol>
            </nav>
            <h2 class="h4">Detail Pesanan</h2>
            <p class="mb-0">Informasi lengkap pesanan Bakpao & Dimsum.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('pesan.list') }}" class="btn btn-sm btn-warning">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🧾 Pesanan #{{ str_pad($pesanan->pesanan_id, 6, '0', STR_PAD_LEFT) }}</h5>
                    <span>
                        @if($pesanan->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($pesanan->status == 'confirmed') <span class="badge bg-info">Dikonfirmasi</span>
                        @elseif($pesanan->status == 'processing') <span class="badge bg-primary">Diproses</span>
                        @elseif($pesanan->status == 'ready') <span class="badge bg-success">Siap</span>
                        @elseif($pesanan->status == 'completed') <span class="badge bg-secondary">Selesai</span>
                        @elseif($pesanan->status == 'cancelled') <span class="badge bg-danger">Dibatalkan</span>
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">📋 Detail Pemesanan</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Jenis Produk</th>
                                            <td>{{ $pesanan->jenis_produk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Varian Produk</th>
                                            <td>{{ $pesanan->varian_produk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Pesanan</th>
                                            <td>{{ $pesanan->jumlah_pesanan }} pcs</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pengambilan</th>
                                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pengambilan)->format('d/m/Y H:i') }}
                                            </td>
                                        </tr>
                                        @if($pesanan->catatan_pesanan)
                                            <tr>
                                                <th>Catatan Pesanan</th>
                                                <td>{{ $pesanan->catatan_pesanan }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">👤 Detail Pemesan</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Nama Pemesan</th>
                                            <td>{{ $pesanan->nama_pemesan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kontak (WA)</th>
                                            <td><a href="https://wa.me/{{ $pesanan->kontak_pemesan }}"
                                                    target="_blank">{{ $pesanan->kontak_pemesan }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $pesanan->email_pemesan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">🚚 Detail Pengiriman</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Metode</th>
                                            <td>{{ $pesanan->ambil_di_toko ? 'Ambil di Toko' : 'Dikirim' }}</td>
                                        </tr>
                                        @if(!$pesanan->ambil_di_toko)
                                            <tr>
                                                <th>Alamat Pengiriman</th>
                                                <td>{{ $pesanan->alamat_pengiriman }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Penerima</th>
                                                <td>{{ $pesanan->nama_penerima }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kontak Penerima</th>
                                                <td>{{ $pesanan->kontak_penerima }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">💰 Detail Pembayaran</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Total Harga</th>
                                            <td class="fw-bold text-success">Rp
                                                {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                        @if($pesanan->dp_dibayar)
                                            <tr>
                                                <th>DP Dibayar</th>
                                                <td>Rp {{ number_format($pesanan->dp_dibayar, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Sisa Bayar</th>
                                                <td class="text-danger">Rp
                                                    {{ number_format($pesanan->total_harga - $pesanan->dp_dibayar, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Metode Pembayaran</th>
                                            <td>{{ ucfirst($pesanan->metode_pembayaran ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if($pesanan->status == 'pending') <span
                                                    class="badge bg-warning text-dark">Pending</span>
                                                @elseif($pesanan->status == 'confirmed') <span
                                                    class="badge bg-info">Dikonfirmasi</span>
                                                @elseif($pesanan->status == 'processing') <span
                                                    class="badge bg-primary">Diproses</span>
                                                @elseif($pesanan->status == 'ready') <span
                                                    class="badge bg-success">Siap</span>
                                                @elseif($pesanan->status == 'completed') <span
                                                    class="badge bg-secondary">Selesai</span>
                                                @elseif($pesanan->status == 'cancelled') <span
                                                    class="badge bg-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($pesanan->bukti_pembayaran)
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-light">📎 Bukti Pembayaran</div>
                                    <div class="card-body text-center">
                                        <a href="{{ asset('storage/uploads/' . $pesanan->bukti_pembayaran) }}" target="_blank">
                                            <img src="{{ asset('storage/uploads/' . $pesanan->bukti_pembayaran) }}"
                                                class="img-fluid rounded border" style="max-height: 300px;">
                                        </a>
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/uploads/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                                                class="btn btn-sm btn-primary">Lihat Full</a>
                                            <a href="{{ asset('storage/uploads/' . $pesanan->bukti_pembayaran) }}" download
                                                class="btn btn-sm btn-success">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-secondary mt-2 text-center">Belum ada bukti pembayaran yang diunggah.</div>
                    @endif

                    @if($pesanan->instruksi_khusus)
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-light">📝 Instruksi Khusus</div>
                                    <div class="card-body">{{ $pesanan->instruksi_khusus }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('pesan.list') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('pesan.edit', $pesanan->pesanan_id) }}" class="btn btn-info">Edit Pesanan</a>
                    @if($pesanan->bukti_pembayaran)
                        <a href="{{ asset('storage/uploads/' . $pesanan->bukti_pembayaran) }}" download class="btn btn-success">Download
                            Bukti</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection