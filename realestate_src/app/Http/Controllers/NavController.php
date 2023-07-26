<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\S_info;
use App\Models\Photo;


class NavController extends Controller
{
    public function Info(){
        return view('info');
    }

    public function Sellers_Info()
    {
        $usersWithSellerLicense = User::whereNotNull('seller_license')->get();
        $building = S_info::orderBy('hits', 'desc')->first();

        $s_no = $building ? $building->s_no : null;

        $photos = Photo::where('s_no', $s_no)->where('mvp_photo', 1)->first();

        return view('sellers_info', ['users' => $usersWithSellerLicense, 'photo' => $photos,'bild'=>$building]);
    }


}
