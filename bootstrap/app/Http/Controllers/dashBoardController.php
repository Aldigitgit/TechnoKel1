<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashBoardController extends Controller
{
    public function index() {
                
     
            return view('admin.dashboard');

       
    }
}
