<?php

namespace App\Http\Controllers;


use App\Models\pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datapesan = pesan::latest()->paginate(10);
        return view('pelanggan.index', compact('datapesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi untuk form BAKPAO & DIMSUM
        $validator = Validator::make($request->all(), [
            // ========== Detail Pemesanan ==========
            'jenis_produk' => 'required|string|max:100',
            'varian_produk' => 'required|string|max:100',
            'jumlah_pesanan' => 'required|integer|min:1',
            'tanggal_pengambilan' => 'required|date|after:now',
            'catatan_pesanan' => 'nullable|string',

            // ========== Detail Pengiriman ==========
            'ambil_di_toko' => 'nullable|boolean',
            'alamat_pengiriman' => 'nullable|string',
            'nama_penerima' => 'nullable|string|max:100',
            'kontak_penerima' => 'nullable|string|max:20',

            // ========== Detail Pemesan ==========
            'nama_pemesan' => 'required|string|max:100',
            'kontak_pemesan' => 'required|string|max:20',
            'email_pemesan' => 'required|email|max:100',

            // ========== Detail Pembayaran ==========
            'nominal_dp' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|string',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',

            // ========== Catatan Tambahan ==========
            'instruksi_khusus' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Daftar harga produk
        $hargaproduk = [
            // Bakpao Manis
            'Bakpao Kacang Merah' => 5000,
            'Bakpao Coklat Lumer' => 5000,
            'Bakpao Keju' => 6000,
            'Bakpao Durian' => 5000,
            'Bakpao Kelapa Gula Merah' => 5000,
            'Bakpao Coklat Keju' => 6000,
            // Bakpao Gurih
            'Bakpao Ayam Suwir' => 6000,
            // Risol Mayo
            'Sosis Mayo' => 2000,
            'Beef Mayo' => 2000,
            'Telor Mayo' => 2000,
            'Ayam Suwir Mayo' => 2000,
            'Risol Combo Mayo' => 3000,
            // Dimsum
            'Dimsum Ayam' => 6000,
            'Dimsum Udang' => 6000,
            'Dimsum Keju' => 6000,
            'Dimsum Mix' => 6000,
        ];

        // Hitung total harga
        $hargaSatuan = $hargaproduk[$request->varian_produk] ?? 0;
        $totalHarga = $hargaSatuan * $request->jumlah_pesanan;

        // Siapkan data untuk disimpan
        $data = [
            // Detail Pemesanan
            'jenis_produk' => $request->jenis_produk,
            'varian_produk' => $request->varian_produk,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'tanggal_pengambilan' => $request->tanggal_pengambilan,
            'catatan_pesanan' => $request->catatan_pesanan,

            // Detail Pengiriman
            'ambil_di_toko' => $request->has('ambil_di_toko'),
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'nama_penerima' => $request->nama_penerima,
            'kontak_penerima' => $request->kontak_penerima,

            // Detail Pemesan
            'nama_pemesan' => $request->nama_pemesan,
            'kontak_pemesan' => $request->kontak_pemesan,
            'email_pemesan' => $request->email_pemesan,

            // Detail Pembayaran
            'dp_dibayar' => $request->nominal_dp,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalHarga,

            // Catatan Tambahan
            'instruksi_khusus' => $request->instruksi_khusus,

            // Status awal
            'status' => 'pending',
        ];

        // Handling upload file bukti pembayaran
// Ganti bagian upload file
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . Str::slug($request->nama_pemesan, '_') . '.' . $file->getClientOriginalExtension();
            // Pindahkan ke disk public folder uploads
            $file->storeAs('uploads', $filename, 'public');
            $data['bukti_pembayaran'] = $filename;
        }

        // Simpan data ke database
        $pesanan = pesan::create($data);

        // Redirect ke halaman sukses
        return redirect()->route('pesan.success', $pesanan->pesanan_id)
            ->with('success', 'pesanan berhasil dibuat! Kami akan menghubungi Anda segera.');
    }

    /**
     * Display success page.
     */
    public function success(string $id)
    {
        $pesanan = pesan::findOrFail($id);
        return view('pelanggan.success', compact('pesanan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = pesan::findOrFail($id);
        return view('pelanggan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datapesan = pesan::findOrFail($id);
        return view('pelanggan.edit', compact('datapesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pesanan_id' => 'required|exists:pesanans,pesanan_id',
            'jenis_produk' => 'required|string|max:100',
            'varian_produk' => 'required|string|max:100',
            'jumlah_pesanan' => 'required|integer|min:1',
            'tanggal_pengambilan' => 'required|date',
            'catatan_pesanan' => 'nullable|string',
            'ambil_di_toko' => 'nullable|boolean',
            'alamat_pengiriman' => 'nullable|string',
            'nama_penerima' => 'nullable|string|max:100',
            'kontak_penerima' => 'nullable|string|max:20',
            'nama_pemesan' => 'required|string|max:100',
            'kontak_pemesan' => 'required|string|max:20',
            'email_pemesan' => 'required|email|max:100',
            'dp_dibayar' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|string',
            'status' => 'nullable|in:pending,confirmed,processing,ready,completed,cancelled',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'instruksi_khusus' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pesanan = pesan::findOrFail($request->pesanan_id);

        // Update data
        $pesanan->jenis_produk = $request->jenis_produk;
        $pesanan->varian_produk = $request->varian_produk;
        $pesanan->jumlah_pesanan = $request->jumlah_pesanan;
        $pesanan->tanggal_pengambilan = $request->tanggal_pengambilan;
        $pesanan->catatan_pesanan = $request->catatan_pesanan;
        $pesanan->ambil_di_toko = $request->has('ambil_di_toko');
        $pesanan->alamat_pengiriman = $request->alamat_pengiriman;
        $pesanan->nama_penerima = $request->nama_penerima;
        $pesanan->kontak_penerima = $request->kontak_penerima;
        $pesanan->nama_pemesan = $request->nama_pemesan;
        $pesanan->kontak_pemesan = $request->kontak_pemesan;
        $pesanan->email_pemesan = $request->email_pemesan;
        $pesanan->dp_dibayar = $request->dp_dibayar;
        $pesanan->metode_pembayaran = $request->metode_pembayaran;
        $pesanan->instruksi_khusus = $request->instruksi_khusus;

        if ($request->has('status')) {
            $pesanan->status = $request->status;
        }

        // Update total harga jika varian atau jumlah berubah
        $hargaproduk = [
            // Bakpao Manis
            'Bakpao Kacang Merah' => 5000,
            'Bakpao Coklat Lumer' => 5000,
            'Bakpao Keju' => 6000,
            'Bakpao Durian' => 5000,
            'Bakpao Kelapa Gula Merah' => 5000,
            'Bakpao Coklat Keju' => 6000,
            // Bakpao Gurih
            'Bakpao Ayam Suwir' => 6000,
            // Risol Mayo
            'Sosis Mayo' => 2000,
            'Beef Mayo' => 2000,
            'Telor Mayo' => 2000,
            'Ayam Suwir Mayo' => 2000,
            'Risol Combo Mayo' => 3000,
            // Dimsum
            'Dimsum Ayam' => 6000,
            'Dimsum Udang' => 6000,
            'Dimsum Keju' => 6000,
            'Dimsum Mix' => 6000,
        ];
        $hargaSatuan = $hargaproduk[$request->varian_produk] ?? 0;
        $pesanan->total_harga = $hargaSatuan * $request->jumlah_pesanan;

        // Handling upload file bukti pembayaran
// Ganti bagian upload file
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . Str::slug($request->nama_pemesan, '_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');

            // Hapus file lama
            if ($pesanan->bukti_pembayaran) {
                if (Storage::disk('public')->exists('uploads/' . $pesanan->bukti_pembayaran)) {
                    Storage::disk('public')->delete('uploads/' . $pesanan->bukti_pembayaran);
                }
            }
            $pesanan->bukti_pembayaran = $filename;
        }

        $pesanan->save();

        return redirect()->route('pesan.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesanan = pesan::findOrFail($id);

        // Hapus file bukti pembayaran jika ada
// Hapus file bukti pembayaran jika ada
        if ($pesanan->bukti_pembayaran) {
            if (Storage::disk('public')->exists('uploads/' . $pesanan->bukti_pembayaran)) {
                Storage::disk('public')->delete('uploads/' . $pesanan->bukti_pembayaran);
            }
        }

        $pesanan->delete();

        return redirect()->route('pesan.list')->with('success', 'Penghapusan Data Berhasil!');
    }

    /**
     * Update status pesanan (untuk admin)
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,ready,completed,cancelled',
        ]);

        $pesanan = pesan::findOrFail($id);
        $pesanan->status = $request->status;

        // Set waktu konfirmasi jika status menjadi confirmed
        if ($request->status == 'confirmed' && !$pesanan->confirmed_at) {
            $pesanan->confirmed_at = now();
        }

        // Set waktu selesai jika status menjadi completed
        if ($request->status == 'completed' && !$pesanan->completed_at) {
            $pesanan->completed_at = now();
        }

        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }


}