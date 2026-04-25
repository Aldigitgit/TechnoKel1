@extends('layouts.Admin.app')

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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('Pesan.list') }}">Pesan</a>
                    </li>
                </ol>
            </nav>
            <h2 class="h4">Data Pesan</h2>
            <p class="mb-0">Daftar semua pesanan kue yang masuk.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('Pesan.create') }}"
                class="btn btn-sm btn-success d-inline-flex align-items-center text-white">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Pesan
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
                    <form action="{{ route('Pesan.list') }}" method="GET">
                        <div class="row">
                            {{-- <div class="col-md-2">
                                    <select name="role" id="role" onchange="this.form.submit()" class="form-select">
                                        <option selected="">All roles</option>
                                        <option value="Pesanistrator"{{ request('role') == 'Pesanistrator' ? 'selected' : '' }}>Pesanistrator </option>
                                        <option value="Pelanggan"  {{ request('role') == 'Pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                        <option value="Mitra" {{ request('role') == 'Mitra' ? 'selected' : '' }}>Mitra </option>
                                    </select>
                                </div> --}}
                        </div>
                    </form>
                </div>
                <table class="table table-centered table-nowrap mb-0 rounded" id="table-Pesan">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Jenis Kue</th>
                            <th class="border-0">Ukuran Kue</th>
                            <th class="border-0">Rasa Kue</th>
                            <th class="border-0">Pesan pada Kue</th>
                            <th class="border-0">Tanggal Pengambilan</th>
                            <th class="border-0">Tema Kue</th>
                            <th class="border-0">Alamat Pengiriman</th>
                            <th class="border-0">Nama Penerima</th>
                            <th class="border-0">Kontak Penerima</th>
                            <th class="border-0">Nama Pemesan</th>
                            <th class="border-0">Kontak Pemesan</th>
                            <th class="border-0">Email Pemesan</th>
                            <th class="border-0">Nominal DP</th>
                            <th class="border-0">Metode Pembayaran</th>
                            <th class="border-0">Bukti Pembayaran</th>
                            <th class="border-0">Instruksi Khusus</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($dataPesan as $row)
                            <tr>
                                <td>{{ ++$no }}</td>
                                {{-- <td>{{($dataPesan->currentPage() - 1) * $dataPesan->perPage() + $loop->iteration}}</td> --}}
                                <td>{{ $row->jenis_kue }}</td>
                                <td>{{ $row->ukuran_kue }}</td>
                                <td>{{ $row->rasa_kue }}</td>
                                <td>{{ $row->pesan_kue }}</td>
                                <td>{{ $row->tanggal_pengambilan }}</td>
                                <td>{{ $row->tema_kue }}</td>
                                <td>{{ $row->alamat_pengiriman }}</td>
                                <td>{{ $row->nama_penerima }}</td>
                                <td>{{ $row->kontak_penerima }}</td>
                                <td>{{ $row->nama_pemesan }}</td>
                                <td>{{ $row->kontak_pemesan }}</td>
                                <td>{{ $row->email_pemesan }}</td>
                                <td>{{ number_format($row->nominal_dp, 0, ',', '.') }}</td>
                                <td>{{ $row->metode_pembayaran }}</td>
                                <td>
                                    @if ($row->bukti_pembayaran)
                                        <a href="{{ asset('storage/uploads/' . $row->bukti_pembayaran) }}" target="_blank">Lihat
                                            Bukti</a>
                                    @else
                                        <span class="text-muted">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>{{ $row->instruksi_khusus }}</td>
                                <td>
                                    <a href="{{ route('Pesan.edit', $row->pesan_id) }}" class="btn btn-info btn-sm">
                                        <svg class="icon icon-xs me-2" data-slot="icon" fill="none" stroke-width="1.5"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="{{ route('Pesan.destroy', $row->pesan_id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        <svg class="icon icon-xs me-2" data-slot="icon" fill="none" stroke-width="1.5"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $dataPesan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

