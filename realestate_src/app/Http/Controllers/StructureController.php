<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\S_info;
use App\Models\State_option;
use App\Models\Subway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class StructureController extends Controller
{


    public function structInsertStore (Request $req) {

        // TODO 유효성검사
        // $validator = Validator::make(
        //     $req->all(), [
        //         // 's_name' => 'required|regex:/^(?=.*[가-힣a-zA-Z0-9])+$/|max:30' // 유효성검사 왜 이따구.......
        //         's_name' => 'required|alpha_dash|max:30'
        //         // alpha_dash : 한글 영문 숫자 - _ 다 되는데 ㄱㄱ 이런 글자도 통과됨..
        //         // 's_name' => 'required|regex:/^(?=.*[가-힣])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/u|max:30'
        //         ,'sell_cat_info' => 'required|in:월세,전세,매매'
        //         ,'s_size' => 'required|integer|max:11'
        //         ,'p_deposit' => 'required|integer|max:11'
        //         ,'p_month' => 'nullable|integer|max:11'
        //         ,'s_fl' => 'required|integer'
        //         ,'s_parking' => 'required|in:0,1'
        //         ,'s_ele' => 'required|in:0,1'
        //         // ,'s_addr' => 'required|regex:/^[가-힣0-9]+$/' //일단 주소 api 사용해보고 , 얘도 유효성검사 왜 이따구

        //     ]);
        // if ($validator->fails()) {
        //         return redirect()
        //                 ->back()
        //                 ->withErrors($validator)
        //                 ->withInput($req->all());
        // }

        // db에 있는 역이름이랑 $req 넘어온 역이름 비교 -> 둘이 일치 안하면 에러메세지 뜨게

        // //세션에 id값 가져와서 u_id로 보내줌
        // // 주소 -> 위경도로 바꿔서 보내줌
        // //역이름 보내줘야함
        // // 주소 변환해서 넘겨주기

        // 월세 클릭했을때, 월세값 없이 넘겨주면 에러
        // 전세, 매매일때, 

        //0622 add
        $radio_Btn = $req->sell_cat_info;
        $p_month = $req->p_month;
        $p_deposit = $req->p_deposit;
        if($radio_Btn==="월세" && !$p_month) {
            $error['p_month_err'] = '월세 가격을 적어주세요';
        }
        elseif(($radio_Btn==="전세" || $radio_Btn==="매매") && $p_month) {
            $error['buy_err'] = '거래 유형을 확인하고 가격을 적어주세요';
        }



        // '대구시' 빼고 주소 넘겨주기
        $error = [];
        $s_addr_all = $req->s_addr;
        if(empty($s_addr_all)){
            $error['addr_err'] = '주소를 입력해주세요';
            $pieces="";
            // //return redirect()->back()->with('addr_error', $addr_error);
            // //Session::flash('addr_error', $addr_error);
        }
        elseif(mb_strpos($s_addr_all, '대구') === false) {
            $error['gu_err'] = '대구 지역 주소가 아닙니다';
            $pieces="";
        }
        else {
            $pieces = mb_substr($s_addr_all, 3);
        }


        $sub_name = Subway::where('sub_name', $req->sub_name)->first();
        if(!$sub_name || $sub_name['sub_name'] !== $req->sub_name) {
            $error['sub_err'] ='역 이름을 확인해주세요';
        }

        $user_no = Auth::user()->id; // 유저 넘버 가져오기

        if($error) {
            // 리다이렉트 해서 에러 세션에 담음
            return redirect()->back()->with($error);
        }
        else {

        $data['u_no'] = $user_no;
        $data['s_name'] = $req->s_name;
        $data['s_add'] = $pieces;
        $data['s_type'] = $req->sell_cat_info;
        $data['s_size'] = $req->s_size;
        $data['s_fl'] = $req->s_fl;
        $data['s_log']= $req->s_log;
        $data['s_stai'] = $req->sub_name;
        $data['s_lat']= $req->s_lat;
        $data['p_deposit'] = $req->p_deposit;
        $data['p_month'] = $req->p_month;
        $data['animal_size'] = $req->animal_size;
        $data01['s_parking'] = $req->s_parking;
        $data01['s_ele'] = $req->s_ele;

        $s_info = S_info::create($data);
        State_option::create($data01);
        $s_no = $s_info->id;


        $photos = $req->file('photo');

        // 파일 선택이 안 된 경우
        if (!$photos) {
            return redirect()->back()->withErrors([
                'error' => 'No photos selected'
            ]);
        }
        $photos = is_array($photos) ? $photos : [$photos];

        // 최소 5장, 최대 10장의 사진 검사
        $photos = is_array($photos) ? $photos : [$photos];

    // 최소 5장, 최대 10장의 사진 검사
    $minPhotos = 5;
    $maxPhotos = 10;
    $totalPhotos = count($photos);

    $isFirstPhoto = true; // 첫번째 사진인지 체크

    if ($totalPhotos < $minPhotos || $totalPhotos > $maxPhotos) {
        return redirect()->back()->withErrors([
            'error' => '사진은 ' . $minPhotos . ' 이상 ' . $maxPhotos . ' 이하로 올려주세요'
        ]);
    } else {
        foreach ($photos as $photo) {
            if (!$photo) {
                continue;
            }

            // 확장자 검사
            $extension = $photo->getClientOriginalExtension();
            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->withErrors([
                    'error' => '파일형식은 jpg와 png만 지원합니다'
                ]);
            }
            // Store
                $path = $photo->store('public');

                $mvp_photo = $isFirstPhoto ? '1' : '0'; // 대표 사진 플래그 설정

                $photo = Photo::create([
                    's_no' => $s_no,
                    'url' => Storage::url($path),
                    'hashname' => $photo->hashName(),
                    'originalname' => $photo->getClientOriginalName(),
                    'mvp_photo' => $mvp_photo, // 대표 사진 플래그 저장
                ]);

                $isFirstPhoto = false; // 첫번째 사진 체크 후 '0' 들어가게
            }

            return redirect()->back()->with([
                'status' => '이미지 업로드 성공!'
                ]);
            }
        }
    }

    // 상세 페이지
    public function structDetail() {
        return route('struct.detail.get');
    }
}
