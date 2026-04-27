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
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('produk.list') }}">produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('produk.create') }}">Edit
                            Data</a></li>
                </ol>
            </nav>
            <h2 class="h4">Edit produk</h2>
            <p class="mb-0">Form perubahan data produk.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('produk.list') }}" class="btn btn-sm btn-warning d-inline-flex align-items-center text-white">
                Kembali
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4"></h2>
        <form action="{{ route('produk.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div>
                        <label for="Nama_produk">Nama produk</label>
                        <input class="form-control" id="Nama_produk" type="text" placeholder="Enter your first name"
                            name="Nama_produk" value="{{ $dataproduk->Nama_produk }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div>
                        <label for="jumlah">Jumlah produk</label>
                        <input class="form-control" id="jumlah" type="number" placeholder="Also your last name"
                            name="jumlah" value="{{ $dataproduk->jumlah }}">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">

                <div class="col-md-6 mb-3">
                    <label for="kategori">Kategori</label>
                    <select class="form-select mb-0" id="kategori" aria-label="kategori select example" name="kategori"
                        value="{{ old('kategori') }}">
                        <option selected="">kategori</option>
                        <option value="Bakpao Manis" {{ $dataproduk->kategori == "Bakpao Manis" ? "selected" : "" }}>Bakpao
                            Manis</option>
                        <option value="Bakpao Gurih" {{ $dataproduk->kategori == "Bakpao Gurih" ? "selected" : "" }}>Bakpao
                            Gurih</option>
                        <option value="Bakpao Spesial" {{ $dataproduk->kategori == "Bakpao Spesial" ? "selected" : "" }}>
                            Bakpao
                            Spesial</option>
                        <option value="Dimsum Goreng" {{ $dataproduk->kategori == "Dimsum Goreng" ? "selected" : "" }}>Dimsum
                            Goreng</option>
                        <option value="Risol Mayo" {{ $dataproduk->kategori == "Risol Mayo" ? "selected" : "" }}>Risol Mayo
                        </option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label for="tgl_masuk">tgl_masuk</label>
                    <div class="input-group"><span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg> </span><input data-datepicker="" class="form-control datepicker-input" id="tgl_masuk"
                            name="tgl_masuk" type="date" placeholder="dd/mm/yyyy" required=""
                            value="{{ $dataproduk->tgl_masuk }}"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3"><label for="tgl_expired">tgl_expired</label>
                    <div class="input-group"><span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg> </span><input data-datepicker="" class="form-control datepicker-input" id="tgl_expired"
                            name="tgl_expired" type="date" placeholder="dd/mm/yyyy" required=""
                            value="{{ $dataproduk->tgl_expired }}"></div>
                </div>
            </div>
            <input type="hidden" name="produk_id" value="{{ $dataproduk->produk_id }}" />
            <div class="mt-3">
                <button class="btn btn-info mt-2 animate-up-2" type="submit">Simpan perubahan</button>
            </div>
        </form>
    </div>
@endsection