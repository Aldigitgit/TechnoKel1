<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pemesanan Kue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-primary {
      background-color: #ffcc66; /* Warna primary */
      color: #ffffff; /* Warna teks card */
      border: none;
      border-radius: 20px;
    }
    .form-label {
      color: #333333; /* Warna label agar terlihat */
    }
    .btn-primary {
      background-color: #ff8800;
      border: none;
    }
    .btn-primary:hover {
      background-color: #e67300;
    }
    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }
    .form-section {
      background-color: #fff;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  @if ($errors->any())
    <div class="alert alert-danger mx-5 mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card card-primary p-4 shadow">
          <h3 class="card-title text-center mb-4">Edit Pemesanan Kue</h3>
          <form action="{{ route('Pesan.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pesan_id" value="{{ $dataPesan->pesan_id }}">
            
            <!-- 1. Detail Pemesanan -->
            <div class="form-section shadow-sm">
              <h5>1. Detail Pemesanan</h5>
              <div class="mb-3">
                <label for="jenisKue" class="form-label">Jenis Kue</label>
                <select class="form-select" id="jenisKue" name="jenis_kue">
                  <option value="">Pilih jenis kue...</option>
                  <option value="Brownies" {{ $dataPesan->jenis_kue == 'Brownies' ? 'selected' : '' }}>Brownies</option>
                  <option value="Bolu Gulung" {{ $dataPesan->jenis_kue == 'Bolu Gulung' || $dataPesan->jenis_kue == 'BoluGulung' ? 'selected' : '' }}>Bolu Gulung</option>
                  <option value="Kue Ulang Tahun" {{ $dataPesan->jenis_kue == 'Kue Ulang Tahun' || $dataPesan->jenis_kue == 'KueUlangTahun' ? 'selected' : '' }}>Kue Ulang Tahun</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="ukuranKue" class="form-label">Ukuran atau Jumlah</label>
                <input type="text" class="form-control" id="ukuranKue" name="ukuran_kue" value="{{ $dataPesan->ukuran_kue }}">
              </div>
              <div class="mb-3">
                <label for="rasaKue" class="form-label">Rasa</label>
                <input type="text" class="form-control" id="rasaKue" name="rasa_kue" value="{{ $dataPesan->rasa_kue }}">
              </div>
              <div class="mb-3">
                <label for="pesanKue" class="form-label">Tulisan atau Pesan pada Kue</label>
                <input type="text" class="form-control" id="pesanKue" name="pesan_kue" value="{{ $dataPesan->pesan_kue }}">
              </div>
              <div class="mb-3">
                <label for="tanggalPengambilan" class="form-label">Tanggal dan Waktu Pengambilan/Pengiriman</label>
                <input type="datetime-local" class="form-control" id="tanggalPengambilan" name="tanggal_pengambilan" value="{{ date('Y-m-d\TH:i', strtotime($dataPesan->tanggal_pengambilan)) }}">
              </div>
              <div class="mb-3">
                <label for="temaKue" class="form-label">Desain atau Tema (Opsional)</label>
                <input type="text" class="form-control" id="temaKue" name="tema_kue" value="{{ $dataPesan->tema_kue }}">
              </div>
            </div>

            <!-- 2. Detail Pengiriman -->
            <div class="form-section shadow-sm">
              <h5>2. Detail Pengiriman (jika dikirim)</h5>
              <div class="mb-3">
                <label for="alamatPengiriman" class="form-label">Alamat Pengiriman</label>
                <input type="text" class="form-control" id="alamatPengiriman" name="alamat_pengiriman" value="{{ $dataPesan->alamat_pengiriman }}">
              </div>
              <div class="mb-3">
                <label for="namaPenerima" class="form-label">Nama Penerima</label>
                <input type="text" class="form-control" id="namaPenerima" name="nama_penerima" value="{{ $dataPesan->nama_penerima }}">
              </div>
              <div class="mb-3">
                <label for="kontakPenerima" class="form-label">Nomor Telepon Penerima</label>
                <input type="text" class="form-control" id="kontakPenerima" name="kontak_penerima" value="{{ $dataPesan->kontak_penerima }}">
              </div>
            </div>

            <!-- 3. Detail Pemesan -->
            <div class="form-section shadow-sm">
              <h5>3. Detail Pemesan</h5>
              <div class="mb-3">
                <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="namaPemesan" name="nama_pemesan" value="{{ $dataPesan->nama_pemesan }}">
              </div>
              <div class="mb-3">
                <label for="kontakPemesan" class="form-label">Nomor Kontak Pemesan</label>
                <input type="text" class="form-control" id="kontakPemesan" name="kontak_pemesan" value="{{ $dataPesan->kontak_pemesan }}">
              </div>
              <div class="mb-3">
                <label for="emailPemesan" class="form-label">Email Pemesan</label>
                <input type="email" class="form-control" id="emailPemesan" name="email_pemesan" value="{{ $dataPesan->email_pemesan }}">
              </div>
            </div>

            <!-- 4. Detail Pembayaran -->
            <div class="form-section shadow-sm">
              <h5>4. Detail Pembayaran</h5>
              <div class="mb-3">
                <label for="nominalDP" class="form-label">Nominal DP</label>
                <input type="text" class="form-control" id="nominalDP" name="nominal_dp" value="{{ $dataPesan->nominal_dp }}">
              </div>
              <div class="mb-3">
                <label for="metodePembayaran" class="form-label">Metode Pembayaran DP</label>
                <select class="form-select" id="metodePembayaran" name="metode_pembayaran">
                  <option value="">Pilih metode pembayaran...</option>
                  <option value="transfer" {{ $dataPesan->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                  <option value="ewallet" {{ $dataPesan->metode_pembayaran == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                  <option value="kartuKredit" {{ $dataPesan->metode_pembayaran == 'kartuKredit' || $dataPesan->metode_pembayaran == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit/Debit</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="buktiPembayaran" class="form-label">Unggah Bukti Pembayaran (Biarkan kosong jika tidak diubah)</label>
                <input type="file" class="form-control" id="buktiPembayaran" name="bukti_pembayaran">
                @if($dataPesan->bukti_pembayaran)
                    <div class="mt-2 text-dark">
                        <small>Bukti saat ini: <a href="{{ asset('storage/uploads/' . $dataPesan->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a></small>
                    </div>
                @endif
              </div>
            </div>

            <!-- 5. Catatan Tambahan -->
            <div class="form-section shadow-sm">
              <h5>5. Catatan Tambahan (Opsional)</h5>
              <div class="mb-3">
                <label for="instruksiKhusus" class="form-label">Instruksi Khusus</label>
                <textarea class="form-control" id="instruksiKhusus" name="instruksi_khusus" rows="3">{{ $dataPesan->instruksi_khusus }}</textarea>
              </div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="{{ route('Pesan.list') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
