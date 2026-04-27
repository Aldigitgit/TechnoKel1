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
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.list') }}">pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit pelanggan</li>
            </ol>
        </nav>
        <h2 class="h4">Edit pelanggan</h2>
        <p class="mb-0">Form perubahan data pelanggan.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pelanggan.list') }}" class="btn btn-sm btn-warning d-inline-flex align-items-center text-white">
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
    <h2 class="h5 mb-4">Informasi pelanggan</h2>
    <form action="{{ route('pelanggan.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name">Nama Depan <span class="text-danger">*</span></label>
                <input class="form-control" id="first_name" type="text" placeholder="Masukan nama depan"
                    name="first_name" value="{{ old('first_name', $datapelanggan->first_name) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last_name">Nama Belakang <span class="text-danger">*</span></label>
                <input class="form-control" id="last_name" type="text" placeholder="Masukan nama belakang"
                    name="last_name" value="{{ old('last_name', $datapelanggan->last_name) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="birthday">Tanggal Lahir <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input class="form-control datepicker-input" id="birthday" name="birthday" type="date" 
                        value="{{ old('birthday', $datapelanggan->birthday) }}" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Female" {{ old('gender', $datapelanggan->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Male" {{ old('gender', $datapelanggan->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input class="form-control" id="email" type="email" placeholder="name@company.com"
                    name="email" value="{{ old('email', $datapelanggan->email) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                <input class="form-control" id="phone" type="text" placeholder="081234567890"
                    name="phone" value="{{ old('phone', $datapelanggan->phone) }}" required>
            </div>
        </div>
        <input type="hidden" name="pelanggan_id" value="{{ $datapelanggan->pelanggan_id }}">
        <div class="mt-3">
            <button class="btn btn-info mt-2 animate-up-2" type="submit">Simpan Perubahan</button>
            <a href="{{ route('pelanggan.list') }}" class="btn btn-secondary mt-2">Batal</a>
        </div>
    </form>
</div>
@endsection