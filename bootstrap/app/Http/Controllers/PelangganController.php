<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagedata['datapelanggan'] = pelanggan::all();
        return view('admin.pelanggan.index', $pagedata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
        ]);
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['birthday'] = $request->birthday;
        $data['gender'] = $request->gender;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        pelanggan::create($data);

        return redirect()->route('pelanggan.list')->with('success', 'Penambahan Data Berhasil!');
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
        $pagedata['datapelanggan'] = pelanggan::findOrFail($param1);

        return view('admin.pelanggan.edit', $pagedata);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pelanggan_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
        ]);
        $pelanggan_id = $request->pelanggan_id;
        $pelanggan = pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name = $request->last_name;
        $pelanggan->birthday = $request->birthday;
        $pelanggan->gender = $request->gender;
        $pelanggan->email = $request->email;
        $pelanggan->phone = $request->phone;

        $pelanggan->save();

        return redirect()->route('pelanggan.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $pelanggan = pelanggan::findOrFail($param1);

        $pelanggan->delete();

        return redirect()->route('pelanggan.list')->with('success', 'Penghapusan Data Berhasil!');
    }
}
