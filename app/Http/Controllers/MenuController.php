<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function home() {
        return view('beranda');
    }
    
    public function data_user() {
        return view('user');
    }

    public function change_password() {
        return view('change-password');
    }

}
