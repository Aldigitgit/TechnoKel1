<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class produkController extends Controller
{
    public function index(Request $request)
    {
        $query = produk::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $dataproduk = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('admin.produk.index', compact('dataproduk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:100|unique:produk,nama_produk',
            'jumlah' => 'required|integer|min:0',
            'kategori' => 'required|in:Bakpao Manis,Bakpao Gurih,Bakpao Spesial,Dimsum Goreng,Risol Mayo',
            'harga' => 'required|integer|min:0',
            'tgl_masuk' => 'required|date',
            'tgl_expired' => 'required|date|after:tgl_masuk',
        ], [
            'nama_produk.required' => 'Nama produk harus diisi',
            'nama_produk.unique' => 'Nama produk sudah ada',
            'jumlah.required' => 'Jumlah stok harus diisi',
            'jumlah.min' => 'Jumlah stok minimal 0',
            'kategori.required' => 'Kategori harus dipilih',
            'harga.required' => 'Harga harus diisi',
            'harga.min' => 'Harga minimal 0',
            'tgl_masuk.required' => 'Tanggal masuk harus diisi',
            'tgl_expired.required' => 'Tanggal expired harus diisi',
            'tgl_expired.after' => 'Tanggal expired harus setelah tanggal masuk',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_expired' => $request->tgl_expired,
        ];

        produk::create($data);

        return redirect()->route('produk.list')
            ->with('success', 'produk berhasil ditambahkan!');
    }

    public function edit(string $param1)
    {
        $dataproduk = produk::findOrFail($param1);
        return view('admin.produk.edit', compact('dataproduk'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produk,produk_id',
            'nama_produk' => 'required|string|max:100|unique:produk,nama_produk,' . $request->produk_id . ',produk_id',
            'jumlah' => 'required|integer|min:0',
            'kategori' => 'required|in:Bakpao Manis,Bakpao Gurih,Bakpao Spesial,Dimsum Goreng,Risol Mayo',
            'harga' => 'required|integer|min:0',
            'tgl_masuk' => 'required|date',
            'tgl_expired' => 'required|date|after:tgl_masuk',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $produk = produk::findOrFail($request->produk_id);

        $produk->nama_produk = $request->nama_produk;
        $produk->jumlah = $request->jumlah;
        $produk->kategori = $request->kategori;
        $produk->harga = $request->harga;
        $produk->tgl_masuk = $request->tgl_masuk;
        $produk->tgl_expired = $request->tgl_expired;

        $produk->save();

        return redirect()->route('produk.list')
            ->with('success', 'produk berhasil diperbarui!');
    }

    public function destroy(string $param1)
    {
        $produk = produk::findOrFail($param1);
        $produk->delete();

        return redirect()->route('produk.list')
            ->with('success', 'produk berhasil dihapus!');
    }
}