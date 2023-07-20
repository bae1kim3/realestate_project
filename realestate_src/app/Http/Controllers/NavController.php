<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class NavController extends Controller
{
    public function Info(){
        return view('info');
    }

public function Sellers_Info()
{
    $usersWithSellerLicense = User::whereNotNull('seller_license')->get();

    return view('sellers_info', ['users' => $usersWithSellerLicense]);
}

}
