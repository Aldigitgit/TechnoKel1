<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pagedata['datamitra'] = mitra::all();
        return view('admin.mitra.index', $pagedata);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Nama_mitra' => ['required'],
            'Alamat' => ['required'],
            'Email' => ['required', 'email'],
            'Nomor_Telepon' => ['required', 'numeric'],
            'Kemitraan' => ['required', 'in:Platinum,Gold,Silver'],
            'Bergabung' => ['required', 'date'],
            'confirmation' => 'accepted',
            'confirmation.accepted' => 'Checkbox tidak boleh kosong.',

        ]);

        $data['Nama_mitra'] = $request->Nama_mitra;
        $data['Alamat'] = $request->Alamat;
        $data['Email'] = $request->Email;
        $data['Nomor_Telepon'] = $request->Nomor_Telepon;
        $data['Kemitraan'] = $request->Kemitraan;
        $data['Bergabung'] = $request->Bergabung;

        mitra::create($data);

        return redirect()->route('mitra.list')->with('success', 'Penambahan Data Berhasil!');
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
        $pagedata['datamitra'] = mitra::findOrFail($param1);

        return view('admin.mitra.edit', $pagedata);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'mitra_Id' => ['required'],
            'Nama_mitra' => ['required'],
            'Alamat' => ['required'],
            'Email' => ['required', 'email'],
            'Nomor_Telepon' => ['required', 'Numeric'],
            'Kemitraan' => ['required', 'in:Platinum,Gold,Silver'],
            'Bergabung' => ['required', 'date'],
        ]);
        $mitra_Id = $request->mitra_Id;
        $mitra = mitra::findOrFail($mitra_Id);

        $mitra->Nama_mitra = $request->Nama_mitra;
        $mitra->Alamat = $request->Alamat;
        $mitra->Email = $request->Email;
        $mitra->Nomor_Telepon = $request->Nomor_Telepon;
        $mitra->Kemitraan = $request->Kemitraan;
        $mitra->Bergabung = $request->Bergabung;

        $mitra->save();

        return redirect()->route('mitra.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $mitra = mitra::findOrFail($param1);

        $mitra->delete();

        return redirect()->route('mitra.list')->with('success', 'Penghapusan Data Berhasil!');
    }
}
