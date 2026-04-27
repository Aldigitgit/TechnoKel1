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
                <li class="breadcrumb-item"><a href="{{ route('Admin.list') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <h2 class="h4">Edit User</h2>
        <p class="mb-0">Form perubahan data user.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('Admin.list') }}" class="btn btn-sm btn-warning d-inline-flex align-items-center text-white">
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
    <h2 class="h5 mb-4">Informasi User</h2>
    <form action="{{ route('Admin.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Nama Lengkap</label>
                <input class="form-control" id="name" type="text" placeholder="Masukan nama lengkap" name="name" value="{{ $dataAdmin->name }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input class="form-control" id="email" type="email" placeholder="Masukan email" name="email" value="{{ $dataAdmin->email }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password">Password</label>
                <input class="form-control" id="password" type="password" placeholder="Kosongkan jika tidak ingin mengubah password" name="password">
                <small class="text-muted">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah.</small>
            </div>
            <div class="col-md-6 mb-3">
                <label for="role">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="Administrator" {{ $dataAdmin->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                    <option value="Pelanggan" {{ $dataAdmin->role == 'Pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="Mitra" {{ $dataAdmin->role == 'Mitra' ? 'selected' : '' }}>Mitra</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ $dataAdmin->id }}"/>
        <div class="mt-3">
            <button class="btn btn-info mt-2 animate-up-2" type="submit">Simpan Perubahan</button>
            <a href="{{ route('Admin.list') }}" class="btn btn-secondary mt-2">Batal</a>
        </div>
    </form>
</div>
@endsection