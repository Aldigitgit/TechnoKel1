<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function register()  {
    //     return view('register');
    // }
    // function kirimregister(request $request) {
    //     $username     = $request->username;
    //     $email = $request->email;
    //     $password = $request->password;
    //     $confirm_password = $request->confirm_password;

    //     $request->validate([
    //         'password' => ['min:3','regex:/[A-Z]/'],
    //         'confirm_password' => ['min:3','regex:/[A-Z]/']
    //     ]);
    //     if ($password==$confirm_password) {
    //         session([
    //             'username'=>$request->username,
    //             'email'=>$request->email,
    //             'password'=>$request->password,
    //             'last_login' => date('Y-m-d H:i:s')
    //         ]);
    //         return redirect()->route('login')->with('status', 'terkirim');
    //     }else{
    //         return redirect()->route(route: 'register')->with('status', 'gagal'); 
    //     }

    //     // database
    // }
    public function login()
    {

        return view('login');


    }

    public function kirimlogin(request $request)
    {

        $admin = User::where('email', $request->email)->first();
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
