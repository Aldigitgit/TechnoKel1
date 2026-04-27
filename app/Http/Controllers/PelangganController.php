<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = pelanggan::query();

        if ($request->has('gender') && $request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $datapelanggan = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('admin.pelanggan.index', compact('datapelanggan'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birthday' => 'required|date|before:today',
            'gender' => 'required|in:Female,Male',
            'email' => 'required|email|unique:pelanggan,email',
            'phone' => 'required|string|max:15',
        ], [
            'first_name.required' => 'Nama depan harus diisi',
            'last_name.required' => 'Nama belakang harus diisi',
            'birthday.required' => 'Tanggal lahir harus diisi',
            'birthday.before' => 'Tanggal lahir harus sebelum hari ini',
            'gender.required' => 'Jenis kelamin harus dipilih',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        pelanggan::create($data);

        return redirect()->route('pelanggan.list')
            ->with('success', 'pelanggan berhasil ditambahkan!');
    }

    public function edit(string $param1)
    {
        $datapelanggan = pelanggan::findOrFail($param1);
        return view('admin.pelanggan.edit', compact('datapelanggan'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birthday' => 'required|date|before:today',
            'gender' => 'required|in:Female,Male',
            'email' => 'required|email|unique:pelanggan,email,' . $request->pelanggan_id . ',pelanggan_id',
            'phone' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pelanggan = pelanggan::findOrFail($request->pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name = $request->last_name;
        $pelanggan->birthday = $request->birthday;
        $pelanggan->gender = $request->gender;
        $pelanggan->email = $request->email;
        $pelanggan->phone = $request->phone;

        $pelanggan->save();

        return redirect()->route('pelanggan.list')
            ->with('success', 'pelanggan berhasil diperbarui!');
    }

    public function destroy(string $param1)
    {
        $pelanggan = pelanggan::findOrFail($param1);
        $pelanggan->delete();

        return redirect()->route('pelanggan.list')
            ->with('success', 'pelanggan berhasil dihapus!');
    }
}