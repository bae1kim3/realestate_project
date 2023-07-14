<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\S_info;
use App\Models\Photo;
use App\Models\State_option;
use Illuminate\Support\Facades\DB;

class StructureDetailController extends Controller
{
    public function stateInfo($s_no){
        $photos = Photo::where('s_no', $s_no)->get();
        $s_info = S_info::where('s_no', $s_no)->first();
        $data01 = State_option::where('s_no',$s_no)->first(); 
        $u_no = $s_info->u_no;
        $user = User::find($u_no); // id 값
        session()->put('s_no', $s_info->s_no);
        
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
        return view('sDetail')->with('photos', $photos)->with('user',$user)->with('s_info',$s_info)->with('data01',$data01);
    }
}
