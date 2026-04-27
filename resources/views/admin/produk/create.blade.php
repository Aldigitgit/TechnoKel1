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
                <li class="breadcrumb-item"><a href="{{ route('produk.list') }}">produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah produk</li>
            </ol>
        </nav>
        <h2 class="h4">Tambah produk</h2>
        <p class="mb-0">Form tambah produk baru (Bakpao & Dimsum).</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('produk.list') }}" class="btn btn-sm btn-warning d-inline-flex align-items-center text-white">
            Kembali
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-body border-0 shadow mb-4">
    <h2 class="h5 mb-4">Informasi produk</h2>
    <form action="{{ route('produk.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_produk">Nama produk <span class="text-danger">*</span></label>
                <input class="form-control" id="nama_produk" type="text" placeholder="Contoh: Bakpao Coklat"
                    name="nama_produk" value="{{ old('nama_produk') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="jumlah">Jumlah Stok <span class="text-danger">*</span></label>
                <input class="form-control" id="jumlah" type="number" placeholder="Contoh: 100"
                    name="jumlah" value="{{ old('jumlah') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kategori">Kategori <span class="text-danger">*</span></label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Bakpao Manis" {{ old('kategori') == 'Bakpao Manis' ? 'selected' : '' }}>🥟 Bakpao Manis</option>
                    <option value="Bakpao Gurih" {{ old('kategori') == 'Bakpao Gurih' ? 'selected' : '' }}>🍖 Bakpao Gurih</option>
                    <option value="Bakpao Spesial" {{ old('kategori') == 'Bakpao Spesial' ? 'selected' : '' }}>✨ Bakpao Spesial</option>
                    <option value="Dimsum Goreng" {{ old('kategori') == 'Dimsum Goreng' ? 'selected' : '' }}>🥠 Dimsum Goreng</option>
                    <option value="Risol Mayo" {{ old('kategori') == 'Risol Mayo' ? 'selected' : '' }}>🥐 Risol Mayo</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="harga">Harga Satuan <span class="text-danger">*</span></label>
                <input class="form-control" id="harga" type="number" placeholder="Contoh: 5000"
                    name="harga" value="{{ old('harga') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tgl_masuk">Tanggal Masuk <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input class="form-control datepicker-input" id="tgl_masuk" name="tgl_masuk" type="date" 
                        value="{{ old('tgl_masuk', date('Y-m-d')) }}" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tgl_expired">Tanggal Expired <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input class="form-control datepicker-input" id="tgl_expired" name="tgl_expired" type="date" 
                        value="{{ old('tgl_expired') }}" required>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan</button>
            <a href="{{ route('produk.list') }}" class="btn btn-secondary mt-2">Batal</a>
        </div>
    </form>
</div>
@endsection