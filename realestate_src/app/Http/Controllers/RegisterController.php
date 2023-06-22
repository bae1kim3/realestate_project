<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function u_register(){
        return view('auth.user-register');
    }
    public function seller_register(){
        return view('auth.seller-register');
    }
}
