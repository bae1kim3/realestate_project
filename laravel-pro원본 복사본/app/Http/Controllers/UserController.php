<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function chk_phone_no()
    {
        return view('profile.chk_phone_no');
    }
}

