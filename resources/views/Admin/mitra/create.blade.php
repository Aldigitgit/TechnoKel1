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
                <li class="breadcrumb-item"><a href="{{ route('mitra.list') }}">Mitra</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Mitra</li>
            </ol>
        </nav>
        <h2 class="h4">Tambah Mitra</h2>
        <p class="mb-0">Form tambah mitra baru.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('mitra.list') }}" class="btn btn-sm btn-warning d-inline-flex align-items-center text-white">
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
    <h2 class="h5 mb-4">Informasi Mitra</h2>
    <form action="{{ route('mitra.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Nama_Mitra">Nama Mitra <span class="text-danger">*</span></label>
                <input class="form-control" id="Nama_Mitra" type="text" placeholder="Masukan nama mitra"
                    name="Nama_Mitra" value="{{ old('Nama_Mitra') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Alamat">Alamat <span class="text-danger">*</span></label>
                <input class="form-control" id="Alamat" type="text" placeholder="Masukan alamat lengkap" 
                    name="Alamat" value="{{ old('Alamat') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Email">Email <span class="text-danger">*</span></label>
                <input class="form-control" id="Email" type="email" placeholder="name@company.com" 
                    name="Email" value="{{ old('Email') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Nomor_Telepon">Nomor Telepon <span class="text-danger">*</span></label>
                <input class="form-control" id="Nomor_Telepon" type="text" placeholder="081234567890" 
                    name="Nomor_Telepon" value="{{ old('Nomor_Telepon') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Kemitraan">Level Kemitraan <span class="text-danger">*</span></label>
                <select class="form-select" id="Kemitraan" name="Kemitraan" required>
                    <option value="">Pilih Level Kemitraan</option>
                    <option value="Platinum" {{ old('Kemitraan') == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                    <option value="Gold" {{ old('Kemitraan') == 'Gold' ? 'selected' : '' }}>Gold</option>
                    <option value="Silver" {{ old('Kemitraan') == 'Silver' ? 'selected' : '' }}>Silver</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Bergabung">Tanggal Bergabung <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input class="form-control datepicker-input" id="Bergabung" name="Bergabung" type="date" 
                        value="{{ old('Bergabung', date('Y-m-d')) }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-check">
                    <input type="checkbox" name="confirmation" id="confirmation" class="form-check-input" value="1" {{ old('confirmation') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="confirmation">
                        Data ini benar dan dapat dipertanggungjawabkan dengan semestinya
                    </label>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan</button>
            <a href="{{ route('mitra.list') }}" class="btn btn-secondary mt-2">Batal</a>
        </div>
    </form>
</div>
@endsection