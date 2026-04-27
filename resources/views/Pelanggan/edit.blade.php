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
          <form action="{{ route('pesan.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pesan_id" value="{{ $dataPesan->pesan_id }}">
            
            <!-- 1. Detail Pemesanan -->
            <div class="form-section shadow-sm">
              <h5>1. Detail Pemesanan</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="jenis_produk" class="form-label">Jenis Produk</label>
                  <select class="form-select" id="jenis_produk" name="jenis_produk" required>
                    <option value="">Pilih jenis produk...</option>
                    <option value="Bakpao Manis" {{ $dataPesan->jenis_produk == 'Bakpao Manis' ? 'selected' : '' }}>🥟 Bakpao Manis</option>
                    <option value="Bakpao Gurih" {{ $dataPesan->jenis_produk == 'Bakpao Gurih' ? 'selected' : '' }}>🍖 Bakpao Gurih</option>
                    <option value="Risol Mayo" {{ $dataPesan->jenis_produk == 'Risol Mayo' ? 'selected' : '' }}>🌯 Risol Mayo</option>
                    <option value="Dimsum" {{ $dataPesan->jenis_produk == 'Dimsum' ? 'selected' : '' }}>🥠 Dimsum</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="varian_produk" class="form-label">Varian Produk</label>
                  <select class="form-select" id="varian_produk" name="varian_produk" required data-selected="{{ $dataPesan->varian_produk }}">
                    <option value="">Pilih varian...</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="jumlah_pesanan" class="form-label">Jumlah Pesanan (pcs)</label>
                  <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" value="{{ $dataPesan->jumlah_pesanan }}" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tanggal_pengambilan" class="form-label">Tanggal dan Waktu Pengambilan</label>
                  <input type="datetime-local" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" value="{{ date('Y-m-d\TH:i', strtotime($dataPesan->tanggal_pengambilan)) }}" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="catatan_pesanan" class="form-label">Catatan Pesanan</label>
                <input type="text" class="form-control" id="catatan_pesanan" name="catatan_pesanan" value="{{ $dataPesan->catatan_pesanan }}">
              </div>
            </div>

            <!-- 2. Detail Pengiriman -->
            <div class="form-section shadow-sm">
              <h5>2. Detail Pengiriman (jika dikirim)</h5>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="ambil_di_toko" name="ambil_di_toko" value="1" {{ $dataPesan->ambil_di_toko ? 'checked' : '' }}>
                <label class="form-check-label" for="ambil_di_toko">Ambil sendiri di toko</label>
              </div>
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
              <a href="{{ route('pesan.list') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const varianMap = {
      'Bakpao Manis': ['Bakpao Kacang Merah', 'Bakpao Coklat Lumer', 'Bakpao Keju', 'Bakpao Durian', 'Bakpao Kelapa Gula Merah', 'Bakpao Coklat Keju'],
      'Bakpao Gurih': ['Bakpao Ayam Suwir'],
      'Risol Mayo': ['Sosis Mayo', 'Beef Mayo', 'Telor Mayo', 'Ayam Suwir Mayo', 'Risol Combo Mayo'],
      'Dimsum': ['Dimsum Ayam', 'Dimsum Udang', 'Dimsum Keju', 'Dimsum Mix']
    };

    const jenisSelect = document.getElementById('jenis_produk');
    const varianSelect = document.getElementById('varian_produk');
    const selectedVarian = varianSelect.getAttribute('data-selected');

    function updateVarianOptions() {
      const selectedJenis = jenisSelect.value;
      varianSelect.innerHTML = '<option value="">Pilih varian...</option>';
      
      if (selectedJenis && varianMap[selectedJenis]) {
        varianMap[selectedJenis].forEach(varian => {
          const option = document.createElement('option');
          option.value = varian;
          option.textContent = varian;
          if (varian === selectedVarian) {
            option.selected = true;
          }
          varianSelect.appendChild(option);
        });
        varianSelect.disabled = false;
      } else {
        varianSelect.disabled = true;
      }
    }

    jenisSelect.addEventListener('change', updateVarianOptions);
    updateVarianOptions();
  </script>
</body>
</html>
