@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pesanan</li>
            </ol>
        </nav>
        <h2 class="h4">Data Pesanan</h2>
        <p class="mb-0">Daftar semua pesanan Bakpao & Dimsum yang masuk.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pesan.create') }}" class="btn btn-sm btn-success">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Pesanan
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr><th>#</th><th>Tgl Pesan</th><th>Nama Pemesan</th><th>Jenis Produk</th><th>Varian</th><th>Jumlah</th><th>Tgl Ambil</th><th>Total Harga</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @php $no = ($dataPesan->currentPage() - 1) * $dataPesan->perPage(); @endphp
                    @foreach ($dataPesan as $row)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $row->created_at ? $row->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $row->nama_pemesan }}</td>
                        <td>{{ $row->jenis_produk }}</td>
                        <td>{{ $row->varian_produk }}</td>
                        <td>{{ $row->jumlah_pesanan }} pcs</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_pengambilan)->format('d/m/Y H:i') }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($row->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($row->status == 'confirmed') <span class="badge bg-info">Dikonfirmasi</span>
                            @elseif($row->status == 'processing') <span class="badge bg-primary">Diproses</span>
                            @elseif($row->status == 'ready') <span class="badge bg-success">Siap</span>
                            @elseif($row->status == 'completed') <span class="badge bg-secondary">Selesai</span>
                            @elseif($row->status == 'cancelled') <span class="badge bg-danger">Dibatalkan</span>
                            @else <span class="badge bg-light text-muted">-</span> @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('pesan.show', $row->pesanan_id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('pesan.edit', $row->pesanan_id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('pesan.destroy', $row->pesanan_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $dataPesan->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection