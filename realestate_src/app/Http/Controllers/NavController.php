<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    public function Info(){
        return view('info');
    }
    public function Sellers_Info(){
        return view('sellers_info');
    }
}
