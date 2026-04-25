<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterAbleColumns=['Kemitraan'];
        $searchAbleColumns=['Nama_Mitra'];

        $pagedata['dataMitra'] = Mitra::filter($request, $filterAbleColumns, $searchAbleColumns)
        ->paginate(10)
        ->onEachSide(2)
        ->withQueryString();
        return view('admin.mitra.index', $pagedata);
       
        //     $pagedata['dataMitra'] = Mitra::all();
        // return view('admin.mitra.index', $pagedata);
       
        
       
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
            'Nama_Mitra' => ['required'],
            'Alamat' => ['required'],
            'Email' => ['required', 'email'],
            'Nomor_Telepon' => ['required', 'numeric'],
            'Kemitraan' => ['required', 'in:Platinum,Gold,Silver'],
            'Bergabung' => ['required', 'date'],
            'confirmation' => 'accepted', 
            'confirmation.accepted' => 'Checkbox tidak boleh kosong.',
            
        ]);
        
        $data['Nama_Mitra'] = $request->Nama_Mitra;
        $data['Alamat'] = $request->Alamat;
        $data['Email'] = $request->Email;
        $data['Nomor_Telepon'] = $request->Nomor_Telepon;
        $data['Kemitraan'] = $request->Kemitraan;
        $data['Bergabung'] = $request->Bergabung;

        Mitra::create($data);

        return redirect()->route('Mitra.list')->with('success', 'Penambahan Data Berhasil!');
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
        $pagedata['dataMitra'] = Mitra::findOrFail($param1);

        return view('Admin.Mitra.edit', $pagedata);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'Mitra_Id' => ['required'],
            'Nama_Mitra' => ['required'],
            'Alamat' => ['required'],
            'Email' => ['required', 'email'],
            'Nomor_Telepon' => ['required', 'Numeric'],
            'Kemitraan' => ['required', 'in:Platinum,Gold,Silver'],
            'Bergabung' => ['required', 'date'],
        ]);
        $Mitra_Id=$request->Mitra_Id;
        $Mitra = Mitra::findOrFail($Mitra_Id);

        $Mitra->Nama_Mitra=$request->Nama_Mitra;
        $Mitra->Alamat=$request->Alamat;
        $Mitra->Email=$request->Email;
        $Mitra->Nomor_Telepon=$request->Nomor_Telepon;
        $Mitra->Kemitraan=$request->Kemitraan;
        $Mitra->Bergabung=$request->Bergabung;

        $Mitra->save();

        return redirect()->route('Mitra.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $Mitra = Mitra::findOrFail($param1);

        $Mitra->delete();

        return redirect()->route('Mitra.list')->with('success', 'Penghapusan Data Berhasil!');
    }
}
