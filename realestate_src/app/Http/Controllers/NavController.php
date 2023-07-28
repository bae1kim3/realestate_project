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

        $user_num = User::whereNotNull('u_id')->whereNull('seller_license')->count();

        $seller_num = User::whereNotNull('u_id')->whereNotNull('seller_license')->count();

        $hitsTotal = S_info::whereNotNull('hits')->sum('hits');

        $expen = S_info::whereNotNull('p_deposit')->max('p_deposit');


        // 전화번호에 하이픈찍기
        for($i=0; $i < count($usersWithSellerLicense); $i++) {
        $usersWithSellerLicense[$i]->phone_no = substr($usersWithSellerLicense[$i]->phone_no, 0, 3) . '-' . substr($usersWithSellerLicense[$i]->phone_no, 3, 4) . '-' . substr($usersWithSellerLicense[$i]->phone_no, 7);
        }

        return view('sellers_info', ['users' => $usersWithSellerLicense, 'photo' => $photos,'bild'=>$building,'user_n'=>$user_num,'seller_n'=>$seller_num,'hits'=>$hitsTotal,'expen'=>$expen]);
    }


}
