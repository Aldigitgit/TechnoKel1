<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pemesanan Kue</title>
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
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card card-primary p-4">
          <h3 class="card-title text-center mb-4">Form Pemesanan Kue</h3>
          <form action="{{ route('Pesan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 1. Detail Pemesanan -->
            <div class="form-section">
              <h5>1. Detail Pemesanan</h5>
              <div class="mb-3">
                <label for="jenisKue" class="form-label">Jenis Kue</label>
                <select class="form-select" id="jenisKue" name="jenis_kue">
                  <option selected>Pilih jenis kue...</option>
                  <option value="Brownies">Brownies</option>
                  <option value="BoluGulung">Bolu Gulung</option>
                  <option value="KueUlangTahun">Kue Ulang Tahun</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="ukuranKue" class="form-label">Ukuran atau Jumlah</label>
                <input type="text" class="form-control" id="ukuranKue" name="ukuran_kue" placeholder="Contoh: 1 kg atau 12 cupcakes">
              </div>
              <div class="mb-3">
                <label for="rasaKue" class="form-label">Rasa</label>
                <input type="text" class="form-control" id="rasaKue" name="rasa_kue" placeholder="Contoh: cokelat, red velvet">
              </div>
              <div class="mb-3">
                <label for="pesanKue" class="form-label">Tulisan atau Pesan pada Kue</label>
                <input type="text" class="form-control" id="pesanKue" name="pesan_kue" placeholder="Contoh: 'Happy Birthday'">
              </div>
              <div class="mb-3">
                <label for="tanggalPengambilan" class="form-label">Tanggal dan Waktu Pengambilan/Pengiriman</label>
                <input type="datetime-local" class="form-control" id="tanggalPengambilan" name="tanggal_pengambilan">
              </div>
              <div class="mb-3">
                <label for="temaKue" class="form-label">Desain atau Tema (Opsional)</label>
                <input type="text" class="form-control" id="temaKue" name="tema_kue" placeholder="Contoh: warna pastel, tema ulang tahun">
              </div>
            </div>

            <!-- 2. Detail Pengiriman -->
            <div class="form-section">
              <h5>2. Detail Pengiriman (jika dikirim)</h5>
              <div class="mb-3">
                <label for="alamatPengiriman" class="form-label">Alamat Pengiriman</label>
                <input type="text" class="form-control" id="alamatPengiriman" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap">
              </div>
              <div class="mb-3">
                <label for="namaPenerima" class="form-label">Nama Penerima</label>
                <input type="text" class="form-control" id="namaPenerima" name="nama_penerima" placeholder="Nama penerima pesanan">
              </div>
              <div class="mb-3">
                <label for="kontakPenerima" class="form-label">Nomor Telepon Penerima</label>
                <input type="text" class="form-control" id="kontakPenerima" name="kontak_penerima" placeholder="Nomor telepon penerima">
              </div>
            </div>

            <!-- 3. Detail Pemesan -->
            <div class="form-section">
              <h5>3. Detail Pemesan</h5>
              <div class="mb-3">
                <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="namaPemesan" name="nama_pemesan" placeholder="Nama lengkap pemesan">
              </div>
              <div class="mb-3">
                <label for="kontakPemesan" class="form-label">Nomor Kontak Pemesan</label>
                <input type="text" class="form-control" id="kontakPemesan" name="kontak_pemesan" placeholder="Nomor telepon pemesan">
              </div>
              <div class="mb-3">
                <label for="emailPemesan" class="form-label">Email Pemesan</label>
                <input type="email" class="form-control" id="emailPemesan" name="email_pemesan" placeholder="Alamat email pemesan">
              </div>
            </div>

            <!-- 4. Detail Pembayaran -->
            <div class="form-section">
              <h5>4. Detail Pembayaran</h5>
              <div class="mb-3">
                <label for="nominalDP" class="form-label">Nominal DP</label>
                <input type="text" class="form-control" id="nominalDP" name="nominal_dp" placeholder="Contoh: 50% dari total harga">
              </div>
              <div class="mb-3">
                <label for="metodePembayaran" class="form-label">Metode Pembayaran DP</label>
                <select class="form-select" id="metodePembayaran" name="metode_pembayaran">
                  <option selected>Pilih metode pembayaran...</option>
                  <option value="transfer">Transfer Bank</option>
                  <option value="ewallet">E-Wallet</option>
                  <option value="kartuKredit">Kartu Kredit/Debit</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="buktiPembayaran" class="form-label">Unggah Bukti Pembayaran</label>
                <input type="file" class="form-control" id="buktiPembayaran" name="bukti_pembayaran">
              </div>
            </div>

            <!-- 5. Catatan Tambahan -->
            <div class="form-section">
              <h5>5. Catatan Tambahan (Opsional)</h5>
              <div class="mb-3">
                <label for="instruksiKhusus" class="form-label">Instruksi Khusus</label>
                <textarea class="form-control" id="instruksiKhusus" name="instruksi_khusus" rows="3" placeholder="Contoh: alergi tertentu, bahan khusus"></textarea>
              </div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
