<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPesan = Pesan::latest()->paginate(10);
        return view('Pelanggan.index', compact('dataPesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'Pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Detail Pemesanan
            'jenis_kue' => ['required'],
            'ukuran_kue' => ['required'],
            'rasa_kue' => ['required'],
            'pesan_kue' => ['nullable', 'string'],
            'tanggal_pengambilan' => ['required', 'date'],
            'tema_kue' => ['nullable', 'string'],
    
            // // Detail Pengiriman
            'alamat_pengiriman' => ['nullable', 'string'],
            'nama_penerima' => ['nullable', 'string'],
            'kontak_penerima' => ['nullable', 'numeric'],
    
            // // Detail Pemesan
            'nama_pemesan' => ['required', 'string'],
            'kontak_pemesan' => ['required', 'numeric'],
            'email_pemesan' => ['required', 'email'],
    
            // // Detail Pembayaran
            'nominal_dp' => ['nullable', 'numeric'],
            'metode_pembayaran' => ['nullable', 'string'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:jpeg,png,jpg'], // jika ada file gambar
    
            // Catatan Tambahan
            'instruksi_khusus' => ['nullable', 'string'],
        ]);
    
        $data['jenis_kue'] = $request->jenis_kue;
        $data['ukuran_kue'] = $request->ukuran_kue;
        $data['rasa_kue'] = $request->rasa_kue;
        $data['pesan_kue'] = $request->pesan_kue;
        $data['tanggal_pengambilan'] = $request->tanggal_pengambilan;
        $data['tema_kue'] = $request->tema_kue;
    
        $data['alamat_pengiriman'] = $request->alamat_pengiriman;
        $data['nama_penerima'] = $request->nama_penerima;
        $data['kontak_penerima'] = $request->kontak_penerima;
    
        $data['nama_pemesan'] = $request->nama_pemesan;
        $data['kontak_pemesan'] = $request->kontak_pemesan;
        $data['email_pemesan'] = $request->email_pemesan;
    
        $data['nominal_dp'] = $request->nominal_dp;
        $data['metode_pembayaran'] = $request->metode_pembayaran;
    
        // Handling upload file jika ada

        $data = $request->except('bukti_pembayaran');

        if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');

        // Buat nama file berdasarkan timestamp dan nama pemesan
        $filename = time() . '_' . Str::slug($request->nama_pemesan, '_') . '.' . $file->getClientOriginalExtension();

        // Simpan file ke direktori public/storage/uploads
        $file->storeAs('public/uploads', $filename);


        // Simpan nama file ke dalam array data
        $data['bukti_pembayaran'] = $filename;
    }

    // Simpan data ke database
    Pesan::create($data);
        return view('home');
        // return redirect()->route('home')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataPesan = Pesan::findOrFail($id);
        return view('Pelanggan.edit', compact('dataPesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pesan_id' => ['required'],
            'jenis_kue' => ['required'],
            'ukuran_kue' => ['required'],
            'rasa_kue' => ['required'],
            'pesan_kue' => ['nullable', 'string'],
            'tanggal_pengambilan' => ['required', 'date'],
            'tema_kue' => ['nullable', 'string'],
            'alamat_pengiriman' => ['nullable', 'string'],
            'nama_penerima' => ['nullable', 'string'],
            'kontak_penerima' => ['nullable', 'numeric'],
            'nama_pemesan' => ['required', 'string'],
            'kontak_pemesan' => ['required', 'numeric'],
            'email_pemesan' => ['required', 'email'],
            'nominal_dp' => ['nullable', 'numeric'],
            'metode_pembayaran' => ['nullable', 'string'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
            'instruksi_khusus' => ['nullable', 'string'],
        ]);

        $pesan = Pesan::findOrFail($request->pesan_id);

        $pesan->jenis_kue = $request->jenis_kue;
        $pesan->ukuran_kue = $request->ukuran_kue;
        $pesan->rasa_kue = $request->rasa_kue;
        $pesan->pesan_kue = $request->pesan_kue;
        $pesan->tanggal_pengambilan = $request->tanggal_pengambilan;
        $pesan->tema_kue = $request->tema_kue;
        $pesan->alamat_pengiriman = $request->alamat_pengiriman;
        $pesan->nama_penerima = $request->nama_penerima;
        $pesan->kontak_penerima = $request->kontak_penerima;
        $pesan->nama_pemesan = $request->nama_pemesan;
        $pesan->kontak_pemesan = $request->kontak_pemesan;
        $pesan->email_pemesan = $request->email_pemesan;
        $pesan->nominal_dp = $request->nominal_dp;
        $pesan->metode_pembayaran = $request->metode_pembayaran;
        $pesan->instruksi_khusus = $request->instruksi_khusus;

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . Str::slug($request->nama_pemesan, '_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename);
            
            if ($pesan->bukti_pembayaran) {
                Storage::delete('public/uploads/' . $pesan->bukti_pembayaran);
            }
            $pesan->bukti_pembayaran = $filename;
        }

        $pesan->save();

        return redirect()->route('Pesan.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesan = Pesan::findOrFail($id);
        if ($pesan->bukti_pembayaran) {
            Storage::delete('public/uploads/' . $pesan->bukti_pembayaran);
        }
        $pesan->delete();

        return redirect()->route('Pesan.list')->with('success', 'Penghapusan Data Berhasil!');
    }
}
