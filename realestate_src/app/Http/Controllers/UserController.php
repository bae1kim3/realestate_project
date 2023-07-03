<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\S_info;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\State_option;

class UserController extends Controller
{

    public function chk_phone_no()
    {
        return view('profile.chk_phone_no');
    }

    public function chkDelUser()
    {
        return view('chk_del_user');
    }

    public function chkDelUserPost(Request $req)
    {
        // ** 글 O 공인중개사 탈퇴**
        $id = Auth::user()->id; // 유저 넘버 pk
        $user = User::find($id); //유저 정보 가져옴

        // S_info::where('u_no', $id)->get()->toArray() 숫자 가져오는 체이닝 메소드
        if (($user->seller_license) && S_info::where('u_no', $id)->get()->toArray()) {
            $validator = Validator::make($req->all(), [
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($req->all());
            }
            $pw_check = Hash::check($req->password, $user->password);

            if (!$pw_check) {
                $error = "비밀번호가 일치하지 않습니다.";
                return redirect()->back()->with('error', $error);
            }

            $s_no = S_info::where('u_no', $id)->select('s_no')->get()->toArray();
            $s_option = State_option::whereIn('s_no', $s_no)->select('s_no')->get()->toArray();
            $photo_p_no_list = Photo::whereIn('s_no', $s_no)->select('p_no')->get()->toArray();

            // Photos 삭제
            $photo_deleted_rows = Photo::whereIn('p_no', $photo_p_no_list)->delete();
            if ($photo_deleted_rows) {
                // state_option 삭제
                $stat_deleted_rows = State_option::whereIn('s_no', $s_option)->delete();
                if ($stat_deleted_rows) {
                    // s_info 삭제
                    $sinfo_deleted_rows = S_info::where('u_no', $id)->delete();
                    if ($sinfo_deleted_rows) {
                        //user 삭제
                        $user->delete();
                    } else {
                        $error = "다시 시도해주세요1";
                        return redirect()->back()->with('error', $error);
                    }
                } else {
                    $error = "다시 시도해주세요2";
                    return redirect()->back()->with('error', $error);
                }
            } else {
                $error = "다시 시도해주세요3";
                return redirect()->back()->with('error', $error);
            }

            //**********TODO : transaction넣기

            //탈퇴
            // $user->delete();
            Session::flush();
            Auth::logout();
            return redirect()->route('welcome');
        } else {
            // ** 글 X공인중개사, 개인 **
            $id = Auth::user()->id; // 유저 넘버 pk
            $user = User::find($id); //유저 정보 가져옴
            $validator = Validator::make($req->all(), [
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($req->all());
            }
            $pw_check = Hash::check($req->password, $user->password);
            if (!$pw_check || !$user) {
                $error = "비밀번호가 일치하지 않습니다.";
                return redirect()->back()->with('error', $error);
            }
            $user->delete();
            Session::flush();
            Auth::logout();
            return redirect()->route('welcome');
        }
    }

    public function sellerPhone($s_no)
    {
        $s_info = S_info::where('s_no', $s_no)->first();

        if ($s_info) {
            $id = $s_info->u_no;

            $user = User::where('id', $id)->first();

            if ($user) {
                $phone_no = $user->phone_no;

                return view('sellerPhoneNo', ['s_no' => $s_no])->with('phone_no', $phone_no);
            } else {
                return "사용자 정보를 찾을 수 없습니다.";
            }
        } else {
            return "판매자 정보를 찾을 수 없습니다.";
        }
    }
    function logout()
    {
        $id = session('id');
        User::destroy($id);
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('welcome');
    }
}
