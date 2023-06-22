<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function chk_phone_no()
    {
        return view('profile.chk_phone_no');
    }
     //탈퇴
    public function chkDelUser()
    {
        return view('profile.chk_del_user');
    }

    public function chkDelUserPost(Request $req)
    {
        $id = Auth::user()->id; // 유저 넘버 pk
        
        $user = User::find($id); //유저 정보 가져옴
        $validator = Validator::make($req->all(), [
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,20}$/'
        ]);
        if ($validator->fails()) {
                    return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput($req->all());
            }
        $pw_check = Hash::check($req->password, $user->password);
        if(!$pw_check || !$user)
        {
            $error = "비밀번호가 존재하지 않습니다.";
            return redirect()->back()->with('error', $error);
            
        }
        User::destroy($id);
        Session::flush();
        Auth::logout();
        return redirect()->route('welcome');
    }
}

