@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">DashBoard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mitra</li>
            </ol>
        </nav>
        <h2 class="h4">Data Mitra</h2>
        <p class="mb-0">Daftar semua mitra yang terdaftar.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('Mitra.create') }}" class="btn btn-sm btn-success d-inline-flex align-items-center text-white">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Mitra
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Nama Mitra</th>
                        <th class="border-0">Alamat</th>
                        <th class="border-0">Email</th>
                        <th class="border-0">Telepon</th>
                        <th class="border-0">Level</th>
                        <th class="border-0">Tgl Bergabung</th>
                        <th class="border-0 rounded-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = ($dataMitra->currentPage() - 1) * $dataMitra->perPage();
                    @endphp
                    @forelse ($dataMitra as $row)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td class="fw-semibold">{{ $row->nama_mitra }}</td>
                            <td>{{ Str::limit($row->alamat, 30) }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->nomor_telepon }}</td>
                            <td>
                                @if ($row->kemitraan == 'Platinum')
                                    <span class="badge bg-primary">Platinum</span>
                                @elseif ($row->kemitraan == 'Gold')
                                    <span class="badge bg-warning text-dark">Gold</span>
                                @else
                                    <span class="badge bg-secondary">Silver</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', strtotime($row->bergabung)) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- CARA 1: Menggunakan named route dengan array -->
                                    <a href="{{ route('Mitra.edit', ['Mitra_Id' => $row->mitra_id]) }}" class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                    
                                    <!-- CARA 2: Menggunakan URL manual (alternatif) -->
                                    <!-- <a href="/Mitra/edit/{{ $row->mitra_id }}" class="btn btn-info btn-sm">Edit</a> -->
                                    
                                    <form action="{{ route('Mitra.destroy', $row->mitra_id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus mitra {{ $row->nama_mitra }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                             </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data mitra.</td>
                        </tr>
                    @endforelse
                </tbody>
             </table>
            
            <div class="mt-4">
                {{ $dataMitra->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection