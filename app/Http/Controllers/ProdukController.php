<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterAbleColumns=['kategori'];
        $searchAbleColumns=['nama_produk'];

        $pagedata['dataProduk'] = Produk::filter($request, $filterAbleColumns, $searchAbleColumns)
        ->paginate(10)
        ->onEachSide(2)
        ->withQueryString();
        return view('admin.produk.index', $pagedata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => ['required'],
            'jumlah' => ['required', 'numeric'],
            'kategori' => ['required', 'in:Brownies,Bolu_Gulung,Kue_UlangTahun'],
            'tgl_masuk' => ['required', 'date'],
            'tgl_expired' => ['required', 'date'],
        ]);
        $data['nama_produk'] = $request->nama_produk;
        $data['jumlah'] = $request->jumlah;
        $data['kategori'] = $request->kategori;
        $data['tgl_masuk'] = $request->tgl_masuk;
        $data['tgl_expired'] = $request->tgl_expired;

        Produk::create($data);

        return redirect()->route('produk.list')->with('success', 'Penambahan Data Berhasil!');
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
    public function edit(string $param1)
    {
        $pagedata['dataProduk'] = Produk::findOrFail($param1);

        return view('Admin.produk.edit', $pagedata);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'produk_id' => ['required'],
            'nama_produk' => ['required'],
            'jumlah' => ['required'],
            'kategori' => ['required', 'in:Brownies,Bolu_Gulung,Kue_UlangTahun'],
            'tgl_masuk' => ['required', 'date'],
            'tgl_expired' => ['required', 'date'],
        ]);
        $produk_id=$request->produk_id;
        $produk = Produk::findOrFail($produk_id);

        $produk->nama_produk=$request->nama_produk;
        $produk->jumlah=$request->jumlah;
        $produk->kategori=$request->kategori;
        $produk->tgl_masuk=$request->tgl_masuk;
        $produk->tgl_expired=$request->tgl_expired;

        $produk->save();

        return redirect()->route('produk.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $produk = Produk::findOrFail($param1);

        $produk->delete();

        return redirect()->route('produk.list')->with('success', 'Penghapusan Data Berhasil!');
    }
}
