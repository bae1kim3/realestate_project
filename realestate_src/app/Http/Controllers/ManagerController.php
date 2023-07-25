<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\S_info;
use App\Models\State_option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    function getUser($pageNum) {
        $userList['indiUser'] = User::whereNull('deleted_at')->WhereNull("seller_license")->get();
        $userList['realtorUser'] = User::whereNull('deleted_at')->whereNotNull("seller_license")->get();
        $userList['states'] = S_info::whereNull('deleted_at')->get();
        $limit_num=12;
        $offset = ( $pageNum * $limit_num ) - $limit_num;

        $indiUserCnt = count($userList['indiUser']);
        $userList['max_indiUserPageNum'] = ceil($indiUserCnt/$limit_num);

        $realtorUserCnt = count($userList['realtorUser']);
        $userList['max_realtorUserPageNum'] = ceil($realtorUserCnt/$limit_num);

        $statesCnt = count($userList['states']);
        $userList['max_statesPageNum'] = ceil($statesCnt/$limit_num);

        $userList['indiUser'] = User::whereNull('deleted_at')->WhereNull("seller_license")->offset($offset)
        ->limit($limit_num)
        ->get();
        $userList['realtorUser'] = User::whereNull('deleted_at')->whereNotNull("seller_license")->offset($offset)
        ->limit($limit_num)
        ->get();
        $userList['states'] = S_info::whereNull('deleted_at')->offset($offset)
        ->limit($limit_num)
        ->get();

      return $userList;
    }

    function deleteUser(Request $req){
      if(isset($req['usersNumber'])){
        for($i = 0; $i < count($req['usersNumber']); $i++ ){
          $state_chk=S_info::where('u_no',$req['usersNumber'][$i])->get();
          if(count($state_chk) != 0){
            for($j = 0; $j < count($state_chk); $j++){
            Photo::where('s_no',$state_chk[$j]->s_no)->delete();
            State_option::where('s_no',$state_chk[$j]->s_no)->delete();
            S_info::where('s_no',$state_chk[$j]->s_no)->delete();
            $delete_row[$j] =User::where('id',$req['usersNumber'][$i])->delete();
            }
          }else if(count($state_chk) == 0){
            $delete_row[$i] =User::where('id',$req['usersNumber'][$i])->delete();
          }
        }
      }else if(isset($req['stateNumber'])){
        for($i = 0; $i < count($req['stateNumber']); $i++ ){
          Photo::where('s_no',$req['stateNumber'][$i])->delete();
          State_option::where('s_no',$req['stateNumber'][$i])->delete();
          $delete_row[$i] = S_info::where('s_no',$req['stateNumber'][$i])->delete();
        }
      }

      return $delete_row;
    }

    function adminLoginCheck(Request $req){
        $Adminget =DB::table('admin_info')->get();
        if($Adminget[0]->adm_id == $req['data']['AdminId'] && $Adminget[0]->adm_pw == $req['data']['AdminPw']){
            $successCheck = '1';
            return $successCheck;
        }else{
            $successCheck = '0';
            return $successCheck;
        }
    }
    function search($searchWorld, $listNumber, $pageNum){
        $limit_num=12;
        $offset = ( $pageNum * $limit_num ) - $limit_num;
        if($listNumber == 0){
            $userList['indiUser']  = User::whereNull('deleted_at')->WhereNull("seller_license")->where(function ($query) use ($searchWorld) {
                            $query->where('name', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('id', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('u_id', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('email', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('phone_no', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('u_addr', 'LIKE', "%".$searchWorld."%");})
                            ->get();
                        $indiUserCnt = count($userList['indiUser']);
                        $userList['max_indiUserPageNum'] = ceil($indiUserCnt/$limit_num);
            $userList['indiUser']  = User::whereNull('deleted_at')->WhereNull("seller_license")->where(function ($query) use ($searchWorld) {
                            $query->where('name', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('id', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('u_id', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('email', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('phone_no', 'LIKE', "%".$searchWorld."%")
                            ->orWhere('u_addr', 'LIKE', "%".$searchWorld."%");})
                            ->offset($offset)
                            ->limit($limit_num)
                            ->get();
                            if(count($userList['indiUser']) != 0){
                                return $userList;
                            }else{
                            $userList['err'] = '검색결과가 없습니다.';
                            return $userList;
                            }

        }
        if($listNumber == 1){
            $userList['realtorUser']  = User::whereNull('deleted_at')->whereNotNull("seller_license")->where(function ($query) use ($searchWorld) {
                $query->where('name', 'LIKE', "%".$searchWorld."%")
                ->orWhere('id', 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_id', 'LIKE', "%".$searchWorld."%")
                ->orWhere('email', 'LIKE', "%".$searchWorld."%")
                ->orWhere('phone_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere("seller_license", 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_addr', 'LIKE', "%".$searchWorld."%");})
                ->get();
            $realtorUserCnt = count($userList['realtorUser']);
            $userList['max_realtorUserPageNum'] = ceil($realtorUserCnt/$limit_num);
            $userList['realtorUser']  = User::whereNull('deleted_at')->whereNotNull("seller_license")->where(function ($query) use ($searchWorld) {
                $query->where('name', 'LIKE', "%".$searchWorld."%")
                ->orWhere('id', 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_id', 'LIKE', "%".$searchWorld."%")
                ->orWhere('email', 'LIKE', "%".$searchWorld."%")
                ->orWhere('phone_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere("seller_license", 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_addr', 'LIKE', "%".$searchWorld."%");})
                ->offset($offset)
                ->limit($limit_num)
                ->get();
                if(count($userList['realtorUser']) != 0){
                    return $userList;
                }else{
                $userList['err'] = '검색결과가 없습니다.';
                return $userList;
                }
        }
        if($listNumber == 2){
            $userList['states']  = S_info::whereNull('deleted_at')->where(function ($query) use ($searchWorld) {
                $query->where('s_name', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_add', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_type', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_size', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_stai', 'LIKE', "%".$searchWorld."%");})
                ->get();
            $statesCnt = count($userList['states']);
            $userList['max_statesPageNum'] = ceil($statesCnt/$limit_num);
            $userList['states']  = S_info::whereNull('deleted_at')->where(function ($query) use ($searchWorld) {
                $query->where('s_name', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere('u_no', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_add', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_type', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_size', 'LIKE', "%".$searchWorld."%")
                ->orWhere('s_stai', 'LIKE', "%".$searchWorld."%");})
                ->offset($offset)
                ->limit($limit_num)
                ->get();
                if(count($userList['states']) != 0){
                    return $userList;
                }else{
                $userList['err'] = '검색결과가 없습니다.';
                return $userList;
                }
        }
    }
}
