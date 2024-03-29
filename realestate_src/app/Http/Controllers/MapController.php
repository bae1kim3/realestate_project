<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MapController extends Controller
{
    function map()
    {
        if (!empty(session('u_id'))) {
            $u_info = User::where('u_id', (session()->get('u_id')))->first();
            return view('map')->with('u_info', $u_info);
        } else {
            return view('map');
        }
    }

    function getopt($opt, $gu, $sopt, $sshape)
    {
        $lat = 0;
        $lng = 0;
        // 구,군따라 기준 위 경도 설정
        switch ($gu) {
            case "구 선택":
                $lat = 35.8714354;
                $lng = 128.601445;
                break;
            case "달서구":
                $lat = 35.82997744;
                $lng = 128.5325905;
                break;
            case "달성군":
                $lat = 35.77475029;
                $lng = 128.4313995;
                break;
            case "북구":
                $lat = 35.8858646;
                $lng = 128.5828924;
                break;
            case "남구":
                $lat = 35.84621351;
                $lng = 128.597702;
                break;
            case "서구":
                $lat = 35.87194054;
                $lng = 128.5591601;
                break;
            case "중구":
                $lat = 35.86952722;
                $lng = 128.6061745;
                break;
            case "수성구":
                $lat = 35.85835148;
                $lng = 128.6307011;
                break;
            case "동구":
                $lat = 35.88682728;
                $lng = 128.6355584;
                break;
            default:
                // 기본값 설정
                $lat = 0;
                $lng = 0;
                break;
        }
        $info['latlng'] = ['lat' => $lat, 'lng' => $lng];
        // 받아온 값들 ,단위로 잘라서 배열에 삽입
        $array = explode(',', $opt);
        $soptarray = explode(',', $sopt);
        $sshapearray = explode(',', $sshape);
    
        // 매매가 평균 구하는 쿼리
        if ($gu != '구 선택') {
            $info['trade'] = DB::table('s_infos')
                ->select('p_deposit', 's_type')
                ->where('s_add', 'LIKE', $gu . '%')
                ->where('s_type', '매매')
                ->whereNull('deleted_at')
                ->get();
            $info['jeonse'] = DB::table('s_infos')
                ->select('p_deposit', 's_type')
                ->where('s_add', 'LIKE', $gu . '%')
                ->where('s_type', '전세')
                ->whereNull('deleted_at')
                ->get();
            $info['monthly'] = DB::table('s_infos')
                ->select('p_deposit', 's_type', 'p_month')
                ->where('s_add', 'LIKE', $gu . '%')
                ->where('s_type', '월세')
                ->whereNull('deleted_at')
                ->get();
        } else {
            $info['trade'] = DB::table('s_infos')
                ->select('p_deposit', 's_type')
                ->where('s_type', '매매')
                ->whereNull('deleted_at')
                ->get();
            $info['jeonse'] = DB::table('s_infos')
                ->select('p_deposit', 's_type')
                ->where('s_type', '전세')
                ->whereNull('deleted_at')
                ->get();
            $info['monthly'] = DB::table('s_infos')
                ->select('p_deposit', 's_type', 'p_month')
                ->where('s_type', '월세')
                ->whereNull('deleted_at')
                ->get();
        }

        // 검색쿼리
        $info['sinfo'] = DB::table('s_infos AS sinfo')
            ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
            ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
            ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
            // 구,군
            ->when($gu, function ($query, $gu) {
                if ($gu == '구 선택') {
                    return $query;
                } else {
                    return $query->where('sinfo.s_add', 'LIKE', $gu . '%');
                }
            })
            // 거래유형
            ->when($array[0] != '1', function ($query) use ($array) {
                return $query->whereIn('sinfo.s_type', $array);
            })
            // 건물유형
            ->when($sshapearray[0] != 'n', function ($query) use ($sshapearray) {
                return $query->whereIn('sinfo.s_option', $sshapearray);
            })
            // 옵션 선택(엘베, 주차)
            ->when($soptarray[0] != '1', function ($query) use ($soptarray) {
                return $query->where(function ($query) use ($soptarray) {
                    foreach ($soptarray as $value) {
                        $query->orWhere('sopt.' . $value, '1');
                    }
                });
            })
            ->where('phot.mvp_photo', '1')
            ->whereNull('phot.deleted_at')
            ->orderByDesc('sinfo.s_type')
            ->get();

        return $info;
    }
}


// 0727 동적쿼리 구현으로 인한 삭제

// function getopt($opt, $gu, $sopt, $sshape)
// {
//     Log::info($sshape);
//     $lat = 0;
//     $lng = 0;
//     switch ($gu) {
//         case "구 선택":
//             $lat = 35.8714354;
//             $lng = 128.601445;
//             break;
//         case "달서구":
//             $lat = 35.82997744;
//             $lng = 128.5325905;
//             break;
//         case "달성군":
//             $lat = 35.77475029;
//             $lng = 128.4313995;
//             break;
//         case "북구":
//             $lat = 35.8858646;
//             $lng = 128.5828924;
//             break;
//         case "남구":
//             $lat = 35.84621351;
//             $lng = 128.597702;
//             break;
//         case "서구":
//             $lat = 35.87194054;
//             $lng = 128.5591601;
//             break;
//         case "중구":
//             $lat = 35.86952722;
//             $lng = 128.6061745;
//             break;
//         case "수성구":
//             $lat = 35.85835148;
//             $lng = 128.6307011;
//             break;
//         case "동구":
//             $lat = 35.88682728;
//             $lng = 128.6355584;
//             break;
//         default:
//             // 기본값 설정
//             $lat = 0;
//             $lng = 0;
//             break;
//     }
//     $money = DB::table('s_infos AS sinfo')
//         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//         ->select('p_deposit', 's_type')
//         ->where('s_add', 'LIKE', $gu . '%');

//     $info['latlng'] = ['lat' => $lat, 'lng' => $lng];
//     $array = explode(',', $opt);
//     $soptarray = explode(',', $sopt);
//     $sshapearray = explode(',', $sshape);
//     // '구 선택'이 아닐 때
//     if (count($sshapearray) == 1 && $sshapearray[0] == 'n') {
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = $money
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = $money
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = $money
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     } else if (count($sshapearray) == 1 && $sshapearray != 'n') { //****************************************************************************** */
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->where('sinfo.s_option', $sshapearray[0])
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     } else if (count($sshapearray) == 2) { //****************************************************************************** */
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1]])
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     } else if (count($sshapearray) == 3) { //****************************************************************************** */
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2]])
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     } else if (count($sshapearray) == 4) { //****************************************************************************** */
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3]])
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     } else if (count($sshapearray) == 5) { //****************************************************************************** */
//         if ($gu != '구 선택') {
//             // 매매가 평균 구하는 쿼리
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_add', 'LIKE', $gu . '%')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();

//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // '구 선택'이 아닐 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때( 구 만 검색)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('sinfo.s_add', 'LIKE', $gu . '%')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때
//         } else {
//             $info['trade'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '매매')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['jeonse'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type')
//                 ->where('s_type', '전세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             $info['monthly'] = DB::table('s_infos AS sinfo')
//                 ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                 ->select('p_deposit', 's_type', 'p_month')
//                 ->where('s_type', '월세')
//                 ->whereNull('phot.deleted_at')
//                 ->get();
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 하나만 넘어왔을 때
//             if (count($array) == 1 && $array[0] != 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 두개가 넘어왔을 때
//             else if (count($array) == 2) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//             // "구 선택"일 때 '월세', '전세', '매매' 중에서 세개가 넘어왔을 때
//             else if (count($array) == 3) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->select('sinfo.*', 'phot.url')
//                         ->whereIn('sinfo.s_type', [$array[0], $array[1], $array[2]])
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//                 // "구 선택"일 때 '월세', '전세', '매매' 중에서 아무것도 넘어오지 않았을 때(구 선택일 때는 아무 값도 설정하지 않았기 때문에 전체값을 넘겨준다.)
//             } else if ($array[0] == 1) {
//                 if ((count($soptarray) == 1 && $soptarray[0] != 1) && $soptarray[0] == 's_parking' || $soptarray[0] == 's_ele') {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ((count($soptarray) == 2 && $soptarray[0] != 1) && in_array("s_parking", $soptarray) && in_array("s_ele", $soptarray)) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->join('state_options AS sopt', 'sinfo.s_no', '=', 'sopt.s_no')
//                         ->select('sinfo.*', 'phot.url', 'sopt.s_parking', 'sopt.s_ele')
//                         ->where($soptarray[0], '1')
//                         ->where($soptarray[1], '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->where('phot.mvp_photo', '1')
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 } else if ($soptarray[0] == 1) {
//                     $info['sinfo'] = DB::table('s_infos AS sinfo')
//                         ->join('photos AS phot', 'sinfo.s_no', '=', 'phot.s_no')
//                         ->where('phot.mvp_photo', '1')
//                         ->whereIn('sinfo.s_option', [$sshapearray[0], $sshapearray[1], $sshapearray[2], $sshapearray[3], $sshapearray[4]])
//                         ->whereNull('phot.deleted_at')
//                         ->orderByDesc('sinfo.s_type')
//                         ->get();
//                     return $info;
//                 }
//             }
//         }
//     }
// }
