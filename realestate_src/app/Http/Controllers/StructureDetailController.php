<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\S_info;
use App\Models\Photo;

class StructureDetailController extends Controller
{
    public function stateInfo($s_no){
        $photos = Photo::where('s_no', $s_no)->get();

        $s_info = S_info::where('s_no', $s_no)->first();
        $u_no = $s_info->u_no;
        $user = User::find($u_no);
        session()->put('s_no', $s_info->s_no);
        return view('sDetail')->with('photos', $photos)->with('user',$user)->with('s_info',$s_info);
    }
}
