<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
        $filterAbleColumns=['role'];

        $pagedata['dataAdmin'] = User::filter($request, $filterAbleColumns)
        ->paginate(10)
        ->onEachSide(2)
        ->withQueryString();
        return view('Admin.Admin.index', $pagedata);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kode untuk Validasi Request
		//
        $request->validate([
		    'name'  => 'required|max:30',
		    'email' => ['required','email'],
        'password' => ['required',],
        'role' => ['required', 'in:Administrator,Pelanggan,Mitra'],
		],
        ['name.required' => 'Silahkan diisikan namanya'
        ]);

		// Kode data user name & Email
		// ...
        $data['name'] = $request->name;
        $data['email'] = $request->email;
		$data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;


	    User::create($data);

		// Kode untuk Redirect & Flash Data Success
		// ...
        return redirect()->route('Admin.list')->with('success', 'Penambahan Data Berhasil!');
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
        $pagedata['dataAdmin'] = User::findOrFail($param1);

        return view('Admin.Admin.edit', $pagedata);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
		    'name'  => 'required|max:30',
		    'email' => ['required','email'],
        'password' => [
		        'required',           // Wajib diisi
		        'string',             // Harus berupa string
		    ], 'role' => ['required', 'in:Administrator,Pelanggan,Mitra'],
		],[
            'name.required' => 'Silahkan diisikan namanya'
        ]);

        $userr_id=$request->userr_id;
        $userr = User::findOrFail($userr_id);

        $userr->name=$request->name;
        $userr->email=$request->email;
        $userr->role=$request->role;
        $userr->password=$request->password;

        $userr->save();

        return redirect()->route('Admin.list')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $userr = User::findOrFail($param1);

        $userr->delete();

        return redirect()->route('Admin.list')->with('success', 'Penghapusan Data Berhasil!');
    }

}