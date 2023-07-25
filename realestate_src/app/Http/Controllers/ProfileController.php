<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Photo;
use App\Models\S_info;
use App\Models\Jjim;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function verifyPhoneNumber(Request $request)
{
    $inputPhoneNo = $request->phone_no;
    $user_id=session('u_id');

    $user = User::where('phone_no', $inputPhoneNo)
                    ->where('u_id',$user_id)->first();

    if ($user) {
        return redirect()->route('up_pass');
    } else {
        return back()->withErrors(['phone_no' => 'Phone number does not match.'])->withInput();
    }
}

    public function UpdatePassPost(Request $request){
        $inputPhoneNo = $request->phone_no;
        $user_id=session('u_id');

    $user = User::where('phone_no', $inputPhoneNo)
                    ->where('u_id',$user_id)->first();

    if ($user) {
        return view('profile.up_pass');
    } else {
        return back()->withErrors(['phone_no' => 'Phone number does not match.'])->withInput();
    }
    }
    public function goPro(){
        $lastPhotoId = 17;
        $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc')
            ->take($lastPhotoId)
            ->get();

        $liked_info = [];
        if(Auth::check()) {
            if(session('seller_license')== null) {
                $id = Auth::user()->id;
                // $liked_list = Jjim::where('id', $id)->select('s_no')->take(10)->get();
                $liked_list = Jjim::where('id', $id)->pluck('s_no')->toArray();

                // $liked_list = Jjim::join('photos', 'photos.s_no', 'jjims.s_no')
                // ->where('id', $id)->where('mvp_photo', '1')
                // ->take(10)
                // ->get();
                // $liked_s_info =

                $liked_info = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
                ->where('mvp_photo', '1')
                ->whereIn('photos.s_no', $liked_list)
                ->orderBy('photos.updated_at', 'desc')
                ->take(10)
                ->get();
            }
            return view('profile.update-profile-information-form', compact('photos', 'lastPhotoId', 'liked_info'));
    }
}
public function sellerprofile(){
    $lastPhotoId = 17;
    $u_id = session('u_id');
    $user = User::where('u_id', $u_id)->first();

    var_dump($user);
    if ($user) {
        $s_info = S_info::where('u_no', $user->id)->first();

        if ($s_info) {
            $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc')
            ->take($lastPhotoId)
            ->get();
            return view('profile.update-profile-information-form', compact('photos', 'lastPhotoId','s_info'));
        } else {
            return redirect()->back()->with('error', 's_info not found.');
        }
    } else {
        return redirect()->back()->with('error', 'User not found.');
    }
}

}
