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
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ route('Mitra.list') }}">Mitra</a></li>
                    </ol>
                </nav>
                <h2 class="h4">Data Mitra</h2>
                <p class="mb-0">Daftar semua mitra yang terdaftar.</p>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('Mitra.create') }}"
                    class="btn btn-sm btn-success d-inline-flex align-items-center text-white">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Mitra
                </a>

            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="mb-3">
                        <form action="{{ route('Mitra.list') }}" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="Kemitraan" id="Kemitraan" onchange="this.form.submit()"
                                        class="form-select">
                                        <option selected="">All Kemitraans</option>
                                        <option value="Platinum"{{ request('Kemitraan') == 'Platinum' ? 'selected' : '' }}>Platinum
                                        </option>
                                        <option value="Gold" {{ request('Kemitraan') == 'Gold' ? 'selected' : '' }}>
                                            Gold</option>
                                        <option value="Silver" {{ request('Kemitraan') == 'Silver' ? 'selected' : '' }}>Silver
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">

                                    <select name="Bergabung" id="Bergabung" onchange="this.form.submit()"
                                        class="form-select">
                                        <option selected="">Pilih tanggal </option>
                                        @for ($i = 2024; $i >= 1900; $i--)
                                            <option value="{{ $i }}"
                                                {{ request('Bergabung') == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
    

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                id="exampleInputIconRight" placeholder="Search" aria-label="Search">
                                            <button type="submit" class="input-group-text" id="basic-addon2">
                                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            @if (request('search'))
                                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                    class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" name="page" value="{{ $dataMitra->currentPage() }}">
                        </form>
                    </div>
                    <table class="table table-centered table-nowrap mb-0 rounded" id="table-Mitra">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">#</th>
                                <th class="border-0">Nama_Mitra</th>
                                <th class="border-0">Alamat</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Telepon</th>
                                <th class="border-0">Kemitraan</th>
                                <th class="border-0">Tanggal_Bergabung</th>
                                <th class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($dataMitra as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->Nama_Mitra }}</td>
                                    <td>{{ $row->Alamat }}</td>
                                    <td>{{ $row->Email }}</td>
                                    <td>{{ $row->Nomor_Telepon }}</td>
                                    <td>
                                        @if ($row->Kemitraan == 'Platinum')
                                            <span class="badge bg-info">Platinum</span>
                                        @elseif ($row->Kemitraan == 'Gold')
                                            <span class="badge bg-warning">Gold</span>
                                        @elseif ($row->Kemitraan == 'Silver')
                                            <span class="badge bg-secondary">Silver</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($row->Bergabung)) }}</td>
                                    <td>
                                        <a href="{{ route('Mitra.edit', $row->Mitra_Id) }}"
                                            class="btn btn-info btn-sm">
                                    
                                            Edit
                                        </a>
                                        <a href="{{ route('Mitra.destroy', $row->Mitra_Id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus mitra ini?')">
                                           
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection
