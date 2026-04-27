<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterAbleColumns = ['role'];
        
        $dataadmin = User::filter($request, $filterAbleColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();
            
        return view('admin.admin.index', compact('dataadmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:administrator,Pelanggan,Mitra',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 30 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        User::create($data);

        return redirect()->route('admin.list')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataadmin = User::findOrFail($id);
        return view('admin.admin.show', compact('dataadmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $param1)
    {
        $dataadmin = User::findOrFail($param1);
        return view('admin.admin.edit', compact('dataadmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi Request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'password' => 'nullable|min:6',  // Password tidak wajib di update
            'role' => 'required|in:administrator,Pelanggan,Mitra',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 30 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan user lain',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($request->user_id);
        
        // Cek jika mencoba mengubah user yang sedang login
        if (Auth::id() == $user->id && $request->role != $user->role) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat mengubah role sendiri!')
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('admin.list')
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $user = User::findOrFail($param1);
        
        // Cek jangan hapus user sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.list')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }
        
        $user->delete();

        return redirect()->route('admin.list')
            ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Update status user (aktivasi/non-aktivasi)
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        
        // Cek jangan non-aktifkan user sendiri
        if (Auth::id() == $user->id && $request->status == 'inactive') {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menonaktifkan akun sendiri!');
        }
        
        $user->status = $request->status;
        $user->save();

        return redirect()->back()
            ->with('success', 'Status user berhasil diperbarui!');
    }
}