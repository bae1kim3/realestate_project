<?php

namespace App\Http\Controllers;

use App\Models\S_info;
use App\Models\Photo;
use App\Models\State_option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        
        // ** 개인유저 탈퇴 **
        if(!(Auth::user()->seller_license)) {
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
            $user->delete();
            Session::flush();
            Auth::logout();
            return redirect()->route('welcome');
        }

    // ** 공인중개사 탈퇴 **
    // 건물정보 있을 때 => 포토 삭제(s_no) -> 건물 옵션 삭제(s_no)->건물정보 삭제(u_no)->유저 삭제 / 없을때 => 바로 삭제 가능
        else {
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

            // user.id = s_infos.u_no 이너조인해서 s_infos에서 u_no 가져옴
                // $s_info_u_no = DB::table('s_infos AS si')
                //                 ->join('users', 'si.u_no', '=', 'users.id')
                //                 ->where('si.u_no', '=', $id)
                //                 ->select('si.u_no')
                //                 ->get(); // del 0625 jy
            $s_info_u_no = S_info::join('users', 's_infos.u_no', '=', 'users.id')
                    ->where('s_infos.u_no', '=', $id)
                    ->select('s_infos.u_no')
                    ->get();
            
            // s_infos.s_no = stat_option.s_no 이너조인 stat_option u_no에 해당하는 s_no 다 불러옴(배열)
            $s_info_s_no = S_info::join('state_options', 's_infos.s_no', '=', 'state_options.s_no')
                    ->where('s_infos.u_no', $id)
                    ->select('s_infos.s_no')
                    ->get();
            // collection에서 s_no 값만 뽑아서 배열에 담음
            $s_no_list = $s_info_s_no->pluck('s_no')->toArray();
            // photos에서 s_no에 해당하는 p_no 다 불러옴(배열)
            $photo_p_no_list = Photo::whereIn('s_no', $s_info_s_no)
                    ->pluck('p_no')
                    ->toArray();

            $pw_check = Hash::check($req->password, $user->password);

            if(!$pw_check || !$user)
            {
                $error = "비밀번호가 존재하지 않습니다.";
                return redirect()->back()->with('error', $error);
            }



            // user가 올린 매물이 없을때 => 바로 탈퇴
            if(empty($s_info_u_no)) {
                
                $user->delete();
                Session::flush();
                Auth::logout();
                return redirect()->route('welcome');
            }
            else 
            { // TODO : user가 올린 매물이 있을 때 => 포토 삭제 -> 건물옵션 삭제-> 건물 삭제 -> user 삭제*************
                // Photos 삭제
                $photo_deleted_rows = Photo::whereIn('p_no', $photo_p_no_list)->delete();
                if($photo_deleted_rows > 0) {
                    // state_option 삭제
                    $stat_deleted_rows = State_option::whereIn('s_no', $s_no_list)->delete();
                    if($stat_deleted_rows>0) {
                        // s_info 삭제
                        $sinfo_deleted_rows = S_info::where('u_no', $id)->delete();
                        if($sinfo_deleted_rows>0) {
                            //user 삭제
                            $user->delete();
                        }
                        else {$error = "다시 시도해주세요";
                            return redirect()->back()->with('error', $error);}
                    }
                    else {$error = "다시 시도해주세요";
                        return redirect()->back()->with('error', $error);}
                }
                else {$error = "다시 시도해주세요";
                    return redirect()->back()->with('error', $error);}
                
                // users에 있는 id랑 s_infos에 있는 u_id 매치해서 같을 때 s_infos 삭제
                // $u_no = $s_info_u_no[0]->u_no;
                // $s_info_s_no = S_info::find($u_no);

                // $u_no_find = S_info::where('u_no', $u_no)->first();
                // $u_no_find->deleted_at = now();
                // $u_no_find->save();

                //탈퇴
                // $user->delete();
                Session::flush();
                Auth::logout();
                return redirect()->route('welcome');
            }
        }   
    }
}

