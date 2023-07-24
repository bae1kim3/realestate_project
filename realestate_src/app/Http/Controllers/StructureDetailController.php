<?php

namespace App\Http\Controllers;

use App\Models\Jjim;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\S_info;
use App\Models\Photo;
use App\Models\State_option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StructureDetailController extends Controller
{
    public function stateInfo($s_no){
        $photos = Photo::where('s_no', $s_no)->get();
        $mvp_photo = Photo::where('mvp_photo', '1')->where('s_no', $s_no)->first();
        // dd($mvp_photo);
        $s_info = S_info::where('s_no', $s_no)->first();
        $data01 = State_option::where('s_no',$s_no)->first(); 
        $u_no = $s_info->u_no;
        $user = User::find($u_no); 
        if( session('u_no') ){
            $id = session('u_no');
        } else {
            $id = null;
        }

        
        //0714 jy add
        // 조회수
        DB::beginTransaction();
        try { 
            $s_info->hits++;
            $s_info->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        
        // 찜 flg 넘겨주기 0719 jy
        
        if(session('u_no')) {
            $userId = session('u_no');

        $liked = Jjim::where('id', $userId)
                ->where('s_no', $s_info->s_no)
                ->exists();

            if(!$liked) {
                $likedFlg = 0;
            } else {
                $likedFlg = 1;
            }
        } else {
            $likedFlg = 0;
        }

        $my_s_no = S_info::where('s_no', $s_info->s_no)->pluck('u_no')->toArray();

        
        return view('sDetail')
        ->with('photos', $photos)
        ->with('user',$user)
        ->with('s_info',$s_info)
        ->with('data01',$data01)
        ->with('mvp_photo', $mvp_photo)
        ->with('likedFlg', $likedFlg)
        ->with('id', $id)
        ->with('my_s_no', $my_s_no);
    }
}
