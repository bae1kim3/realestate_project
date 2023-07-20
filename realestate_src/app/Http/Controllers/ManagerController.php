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
    function getUser() {
      $userList['indiUser'] = User::whereNull('deleted_at')->WhereNull("seller_license")->get();
      $userList['realtorUser'] = User::whereNull('deleted_at')->whereNotNull("seller_license")->get();
      $userList['states'] = S_info::whereNull('deleted_at')->get();
      return $userList;
    }

    function deleteUser(Request $req){
      Log::info($req);
      if(isset($req['usersNumber'])){
        for($i = 0; $i < count($req['usersNumber']); $i++ ){
          $state_chk=S_info::where('u_no',$req['usersNumber'][$i])->get();
          Log::info($state_chk);
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
}
