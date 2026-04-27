<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authcontroller extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function kirimregister(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ], [
            'confirm_password.same' => 'Password konfirmasi tidak cocok.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        user::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Pelanggan',
        ]);

        return redirect()->route('login')->with('status', 'success')->with('username', $request->username);
    }
    public function login()
    {

        return view('login');


    }

    public function kirimlogin(request $request)
    {

        $admin = user::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {

            Auth::login($admin);
            Auth::user()->id;
            Auth::user()->email;
            Auth::user()->name;


            // Kode Redirect ke halaman dashboard
            // ...
            return redirect()->route('dashboard')->with('success', 'Login Berhasil!');

        } else {
            session()->flush();
            return redirect()->route('login')->with('error', 'eror');
        }






        // if ($username==$login && $password==$login) {
        //     // session penyimpanan=>isi
        //     session([
        //         'username'=>$request->username,
        //         'passwrod'=>$request->password,
        //         'email'=>$request->email,
        //         'last_login' => date('Y-m-d H:i:s')
        //     ]);
        //     return redirect('/')->with('status', 'success');
        // }else if ($username==$admin && $password==$admin) {
        //     return redirect()->route('dashboard');
        // }
        // else{
        //     session()->flush();
        //     return redirect()->route('login')->with('status', 'eror');
        // }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('login');

    }

}
