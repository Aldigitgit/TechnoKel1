<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Bakpao & Dimsum | Duha Pao</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* (CSS nya sama seperti yang kamu punya, tidak saya ubah) */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --brown-dark: #4A1E0C;
      --brown: #6B3A2A;
      --brown-mid: #8B4A30;
      --gold: #D4882E;
      --gold-light: #E8A040;
      --cream: #FFF8F0;
      --cream-mid: #FFF2E5;
      --cream-dark: #FFE5CC;
      --muted: #9A7060;
      --text: #2C1A10;
    }

    body {
      font-family: 'Nunito', 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%);
      min-height: 100vh;
      padding: 2rem 0;
      position: relative;
    }

    body::before {
      content: '🥟';
      position: fixed;
      bottom: 20px;
      left: 20px;
      font-size: 120px;
      opacity: 0.05;
      pointer-events: none;
      z-index: 0;
    }

    body::after {
      content: '🥠';
      position: fixed;
      top: 20px;
      right: 20px;
      font-size: 100px;
      opacity: 0.05;
      pointer-events: none;
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
    }

    .order-card {
      background: white;
      border-radius: 32px;
      overflow: hidden;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      transition: transform 0.3s ease;
    }

    .order-card:hover {
      transform: translateY(-5px);
    }

    .card-header-custom {
      background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 50%, var(--brown-mid) 100%);
      padding: 2rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .card-header-custom::before {
      content: '🥟';
      position: absolute;
      bottom: -20px;
      left: -20px;
      font-size: 100px;
      opacity: 0.1;
    }

    .card-header-custom::after {
      content: '🧀';
      position: absolute;
      top: -20px;
      right: -20px;
      font-size: 80px;
      opacity: 0.1;
    }

    .card-header-custom h2 {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      font-weight: 700;
      color: white;
      margin-bottom: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .card-header-custom p {
      color: rgba(255, 212, 168, 0.8);
      font-size: 14px;
      position: relative;
      z-index: 1;
    }

    .form-section {
      background: white;
      border-radius: 20px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(212, 136, 46, 0.15);
      transition: all 0.3s ease;
    }

    .form-section:hover {
      border-color: var(--gold);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--brown-dark);
      margin-bottom: 1.25rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid var(--gold);
      display: inline-block;
    }

    .form-label {
      font-weight: 600;
      font-size: 13px;
      color: var(--brown);
      margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
      border-radius: 12px;
      border: 2px solid #F0E5D8;
      padding: 10px 14px;
      font-size: 14px;
      transition: all 0.3s ease;
      font-family: 'Nunito', sans-serif;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 4px rgba(212, 136, 46, 0.1);
      outline: none;
    }

    textarea.form-control {
      resize: vertical;
      min-height: 80px;
    }

    .required::after {
      content: '*';
      color: #DC2626;
      margin-left: 4px;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
      color: white;
      border: none;
      padding: 14px 32px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(212, 136, 46, 0.3);
      width: 100%;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(212, 136, 46, 0.4);
      background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .alert-custom {
      border-radius: 16px;
      border: none;
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
      animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .alert-danger {
      background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
      color: #991B1B;
      border-left: 4px solid #DC2626;
    }

    .product-preview {
      background: var(--cream-mid);
      border-radius: 16px;
      padding: 1rem;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .product-preview-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: white;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 600;
      color: var(--brown);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-preview-item span {
      font-size: 20px;
    }

    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }
      .card-header-custom h2 {
        font-size: 24px;
      }
      .form-section {
        padding: 1rem;
      }
      .section-title {
        font-size: 18px;
      }
      .product-preview {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .form-section {
        padding: 0.875rem;
      }
      .btn-submit {
        padding: 12px 24px;
        font-size: 14px;
      }
    }

    .btn-submit.loading {
      pointer-events: none;
      opacity: 0.7;
    }

    .btn-submit.loading::after {
      content: ' ⏳';
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      @if ($errors->any())
        <div class="alert-custom alert-danger">
          <strong>❌ Periksa kembali input Anda!</strong>
          <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="order-card">
        <div class="card-header-custom">
          <h2>✨ Pesan Duha Pao ✨</h2>
          <p>Isi form di bawah untuk memesan bakpao, risol, dan dimsum favorit Anda</p>
        </div>

        <div class="p-4 p-md-5">
          <div class="product-preview">
            <div class="product-preview-item"><span>🥟</span> Bakpao Kukus</div>
            <div class="product-preview-item"><span>🌯</span> Risol Mayo</div>
            <div class="product-preview-item"><span>🥠</span> Dimsum</div>
          </div>

          <form action="{{ route('pesan.store') }}" method="post" enctype="multipart/form-data" id="orderForm">
            @csrf

            <!-- 1. Detail Pemesanan -->
            <div class="form-section">
              <h5 class="section-title">📋 Detail Pemesanan</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="jenis_produk" class="form-label required">Jenis Produk</label>
                  <select class="form-select" id="jenis_produk" name="jenis_produk" required>
                    <option value="">Pilih jenis produk...</option>
                    <option value="Bakpao Manis">🥟 Bakpao Manis</option>
                    <option value="Bakpao Gurih">🍖 Bakpao Gurih</option>
                    <option value="Risol Mayo">🌯 Risol Mayo</option>
                    <option value="Dimsum">🥠 Dimsum</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="varian_produk" class="form-label required">Varian Produk</label>
                  <select class="form-select" id="varian_produk" name="varian_produk" required>
                    <option value="">Pilih varian...</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="jumlah_pesanan" class="form-label required">Jumlah Pesanan (pcs)</label>
                  <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" placeholder="Contoh: 10" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tanggal_pengambilan" class="form-label required">Tanggal & Waktu Pengambilan</label>
                  <input type="datetime-local" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="catatan_pesanan" class="form-label">Catatan Pesanan (Opsional)</label>
                <textarea class="form-control" id="catatan_pesanan" name="catatan_pesanan" rows="2" placeholder="Contoh: tidak pakai plastik, potong jadi 4, dll"></textarea>
              </div>
            </div>

            <!-- 2. Detail Pengiriman -->
            <div class="form-section">
              <h5 class="section-title">🚚 Detail Pengiriman</h5>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="ambil_di_toko" name="ambil_di_toko" value="1" onclick="toggleDelivery()">
                <label class="form-check-label" for="ambil_di_toko">
                  Ambil sendiri di toko (tidak perlu dikirim)
                </label>
              </div>
              <div id="deliveryFields">
                <div class="mb-3">
                  <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                  <input type="text" class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap">
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nama_penerima" class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Nama penerima">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="kontak_penerima" class="form-label">Nomor Telepon Penerima</label>
                    <input type="text" class="form-control" id="kontak_penerima" name="kontak_penerima" placeholder="Nomor telepon penerima">
                  </div>
                </div>
              </div>
            </div>

            <!-- 3. Detail Pemesan -->
            <div class="form-section">
              <h5 class="section-title">👤 Detail Pemesan</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama_pemesan" class="form-label required">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" placeholder="Nama lengkap Anda" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="kontak_pemesan" class="form-label required">Nomor WhatsApp</label>
                  <input type="text" class="form-control" id="kontak_pemesan" name="kontak_pemesan" placeholder="08xxxxxxxxxx" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="email_pemesan" class="form-label">Email (Opsional)</label>
                <input type="email" class="form-control" id="email_pemesan" name="email_pemesan" placeholder="Alamat email">
              </div>
            </div>

            <!-- 4. Detail Pembayaran (Opsional) -->
            <div class="form-section">
              <h5 class="section-title">💰 Detail Pembayaran (Opsional)</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nominal_dp" class="form-label">Nominal DP</label>
                  <input type="number" class="form-control" id="nominal_dp" name="nominal_dp" placeholder="Contoh: 50000">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                  <select class="form-select" id="metode_pembayaran" name="metode_pembayaran">
                    <option value="">Pilih metode...</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                    <option value="cash">Cash (Bayar di tempat)</option>
                  </select>
                </div>
              </div>
              <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (jika sudah transfer)</label>
                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
              </div>
              <div class="mb-3">
                <label for="instruksi_khusus" class="form-label">Instruksi Khusus (Opsional)</label>
                <textarea class="form-control" id="instruksi_khusus" name="instruksi_khusus" rows="2" placeholder="Contoh: alergi kacang, ingin packaging khusus, dll"></textarea>
              </div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn-submit" id="submitBtn">
                🛒 Pesan Sekarang
              </button>
            </div>

            <p class="text-center text-muted mt-3" style="font-size: 12px;">
              Kami akan menghubungi Anda via WhatsApp untuk konfirmasi pesanan
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Data varian produk
  const varianMap = {
    'Bakpao Manis': ['Bakpao Kacang Merah', 'Bakpao Coklat Lumer', 'Bakpao Keju', 'Bakpao Durian', 'Bakpao Kelapa Gula Merah', 'Bakpao Coklat Keju'],
    'Bakpao Gurih': ['Bakpao Ayam Suwir'],
    'Risol Mayo': ['Sosis Mayo', 'Beef Mayo', 'Telor Mayo', 'Ayam Suwir Mayo', 'Risol Combo Mayo'],
    'Dimsum': ['Dimsum Ayam', 'Dimsum Udang', 'Dimsum Keju', 'Dimsum Mix']
  };

  const jenisSelect = document.getElementById('jenis_produk');
  const varianSelect = document.getElementById('varian_produk');

  function updateVarianOptions() {
    const selectedJenis = jenisSelect.value;
    varianSelect.innerHTML = '<option value="">Pilih varian...</option>';
    
    if (selectedJenis && varianMap[selectedJenis]) {
      varianMap[selectedJenis].forEach(varian => {
        const option = document.createElement('option');
        option.value = varian;
        option.textContent = varian;
        varianSelect.appendChild(option);
      });
      varianSelect.disabled = false;
    } else {
      varianSelect.disabled = true;
    }
  }

  jenisSelect.addEventListener('change', updateVarianOptions);
  updateVarianOptions();

  // Toggle delivery fields
  function toggleDelivery() {
    const checkbox = document.getElementById('ambil_di_toko');
    const deliveryFields = document.getElementById('deliveryFields');
    
    if (checkbox.checked) {
      deliveryFields.style.display = 'none';
    } else {
      deliveryFields.style.display = 'block';
    }
  }

  // Set minimum datetime
  const datetimeInput = document.getElementById('tanggal_pengambilan');
  const now = new Date();
  now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
  datetimeInput.min = now.toISOString().slice(0, 16);

  toggleDelivery();
</script>

</body>
</html>