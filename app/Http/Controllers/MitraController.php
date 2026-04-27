<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mitra::query();
        
        // Filter berdasarkan level kemitraan
        if ($request->has('Kemitraan') && $request->Kemitraan) {
            $query->where('kemitraan', $request->Kemitraan);
        }
        
        // Filter berdasarkan tahun bergabung
        if ($request->has('tahun') && $request->tahun) {
            $query->whereYear('bergabung', $request->tahun);
        }
        
        // Search berdasarkan nama atau email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mitra', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('nomor_telepon', 'like', '%' . $search . '%');
            });
        }
        
        $dataMitra = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();
            
        return view('admin.mitra.index', compact('dataMitra'));
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
        $validator = Validator::make($request->all(), [
            'Nama_Mitra' => 'required|string|max:200',
            'Alamat' => 'required|string',
            'Email' => 'required|email|unique:mitra,email',
            'Nomor_Telepon' => 'required|string|max:20',
            'Kemitraan' => 'required|in:Platinum,Gold,Silver',
            'Bergabung' => 'required|date',
            'confirmation' => 'accepted',
        ], [
            'Nama_Mitra.required' => 'Nama mitra harus diisi',
            'Alamat.required' => 'Alamat harus diisi',
            'Email.required' => 'Email harus diisi',
            'Email.email' => 'Format email tidak valid',
            'Email.unique' => 'Email sudah terdaftar',
            'Nomor_Telepon.required' => 'Nomor telepon harus diisi',
            'Kemitraan.required' => 'Level kemitraan harus dipilih',
            'Bergabung.required' => 'Tanggal bergabung harus diisi',
            'confirmation.accepted' => 'Harap centang konfirmasi data',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'nama_mitra' => $request->Nama_Mitra,
            'alamat' => $request->Alamat,
            'email' => $request->Email,
            'nomor_telepon' => $request->Nomor_Telepon,
            'kemitraan' => $request->Kemitraan,
            'bergabung' => $request->Bergabung,
        ];

        Mitra::create($data);

        return redirect()->route('mitra.list')
            ->with('success', 'Mitra berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($Mitra_Id)
    {
        $dataMitra = Mitra::findOrFail($Mitra_Id);
        return view('admin.mitra.show', compact('dataMitra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Mitra_Id)
    {
        $dataMitra = Mitra::findOrFail($Mitra_Id);
        return view('admin.mitra.edit', compact('dataMitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mitra_id' => 'required|exists:mitra,mitra_id',
            'Nama_Mitra' => 'required|string|max:200',
            'Alamat' => 'required|string',
            'Email' => 'required|email|unique:mitra,email,' . $request->mitra_id . ',mitra_id',
            'Nomor_Telepon' => 'required|string|max:20',
            'Kemitraan' => 'required|in:Platinum,Gold,Silver',
            'Bergabung' => 'required|date',
        ], [
            'Nama_Mitra.required' => 'Nama mitra harus diisi',
            'Alamat.required' => 'Alamat harus diisi',
            'Email.required' => 'Email harus diisi',
            'Email.email' => 'Format email tidak valid',
            'Email.unique' => 'Email sudah digunakan mitra lain',
            'Nomor_Telepon.required' => 'Nomor telepon harus diisi',
            'Kemitraan.required' => 'Level kemitraan harus dipilih',
            'Bergabung.required' => 'Tanggal bergabung harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mitra = Mitra::findOrFail($request->mitra_id);

        $mitra->nama_mitra = $request->Nama_Mitra;
        $mitra->alamat = $request->Alamat;
        $mitra->email = $request->Email;
        $mitra->nomor_telepon = $request->Nomor_Telepon;
        $mitra->kemitraan = $request->Kemitraan;
        $mitra->bergabung = $request->Bergabung;

        $mitra->save();

        return redirect()->route('mitra.list')
            ->with('success', 'Mitra berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Mitra_Id)
    {
        $mitra = Mitra::findOrFail($Mitra_Id);
        $mitra->delete();

        return redirect()->route('mitra.list')
            ->with('success', 'Mitra berhasil dihapus!');
    }
}