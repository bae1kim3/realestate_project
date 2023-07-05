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


    public function structInsertStore(Request $req)
    {

        // TODO :'한글' 유효성검사
        $validator = Validator::make(
            $req->all(),
            [
                's_name' => 'required|regex:/^[가-힣0-9\s]+$/u|max:30'
                // 's_name' => 'required|alpha_dash|max:30'
                // alpha_dash : 한글 영문 숫자 - _ 다 되는데 ㄱㄱ 이런 글자도 통과됨..
                , 'sell_cat_info' => 'required|in:월세,전세,매매'
                , 's_size' => 'required|integer|max:99999999999'
                , 'p_deposit' => 'required|integer|max:99999999999'
                , 'p_month' => 'nullable|integer|max:99999999999'
                , 'sub_name' => 'required|string||regex:/^[가-힣\s]+$/u'
                , 's_fl' => 'required|integer|max:500', 's_parking' => 'required|in:0,1'
                , 's_ele' => 'required|in:0,1'
                , 's_addr' => 'required|string'
                // ********************* TODO : x,y 위경도 범위 유효성검사 넣기!!

            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }



        // //세션에 id값 가져와서 u_id로 보내줌
        // // 주소 -> 위경도로 바꿔서 보내줌
        // //역이름 보내줘야함
        // // 주소 변환해서 넘겨주기

        $error = [];
        // 월세 클릭했을때, 월세값 없이 넘겨주면 에러
        // 전세, 매매일때, 
        //0622 add jy
        $radio_Btn = $req->sell_cat_info;
        $p_month = $req->p_month;
        $p_deposit = $req->p_deposit;
        if ($radio_Btn === "월세") {
            if ((!$p_month && $p_deposit) || ($p_month && !$p_deposit) || (!$p_month && !$p_deposit)) {
                $error['p_month_err'] = '보증금과 월세 가격을 작성 해주세요';
            }
        } elseif (($radio_Btn === "전세" || $radio_Btn === "매매")) {
            if ($p_month || !$p_deposit) {
                $error['buy_err'] = '거래 유형을 확인하고 가격을 적어주세요';
            }
        }

        // '대구시' 빼고 주소 넘겨주기
        $s_addr_all = $req->s_addr;
        $pieces = "";
        if (!$s_addr_all) {
            $error['addr_err'] = '주소를 입력해주세요';

            // //return redirect()->back()->with('addr_error', $addr_error);
            // //Session::flash('addr_error', $addr_error);
        } elseif (mb_strpos($s_addr_all, '대구') === false) {
            $error['gu_err'] = '대구 지역 주소가 아닙니다';
        } else {
            $pieces = mb_substr($s_addr_all, 3);
        }

        // db에 있는 역이름이랑 $req 넘어온 역이름 비교 -> 둘이 일치 안하면 에러메세지 뜨게
        $sub_name = Subway::where('sub_name', $req->sub_name)->first();
        // if(!$sub_name || $sub_name['sub_name'] !== $req->sub_name) {
        //     $error['sub_err'] ='역 이름을 확인해주세요';
        // }
        if (!$sub_name) {
            $error['sub_err'] = '역 이름을 확인해주세요';
        }

        $user_no = Auth::user()->id; // 유저 넘버 가져오기
        // update 0626 jy : 위치변경
        $photos = $req->file('photo');
        if (!$photos) {
            $error['photo_err'] = '사진을 선택해주세요';
        }

        if (!empty($error)) {
            // 리다이렉트 해서 에러 세션에 담음
            return redirect()->back()->withInput()->withErrors($error);
        } else {

            // if($error) {
            //     // 리다이렉트 해서 에러 세션에 담음
            //     return redirect()->back()->with($error);
            // }
            // else { // del 0626 jy : 위에 중복해서 있음

            $data['u_no'] = $user_no;
            $data['s_name'] = $req->s_name;
            $data['s_add'] = $pieces;
            $data['s_type'] = $req->sell_cat_info;
            $data['s_size'] = $req->s_size;
            $data['s_fl'] = $req->s_fl;
            $data['s_log'] = $req->s_log;
            $data['s_stai'] = $req->sub_name;
            $data['s_lat'] = $req->s_lat;
            $data['p_deposit'] = $req->p_deposit;
            $data['p_month'] = $req->p_month;
            $data['animal_size'] = $req->animal_size;

            // 건물 옵션 del 0625 jy
            // $data01['s_parking'] = $req->s_parking;
            // $data01['s_ele'] = $req->s_ele;

            $s_info_result = S_info::create($data); // 건물 정보 insert
            // *************** TODO : insert 하는 동시에 pk가져오는 체이닝 메소드!!!!!!1번

            // $req->session()->put('result',$s_info_result); // del 0630 jy/ add 0625 jy : view에서 submit 버튼 if 조건문 주는거 때문에 session에 값 넣어줬음

            // State_option::create($data01); // del 0625 jy : s_info db에 넘겨주고 그 다음에 다른 컨트롤러에서 db로 넘겨줌 // del : 이 방법 안씀
            // $s_no = $s_info->id; // del 0625 jy

            // add 0625 jy start
            if ($s_info_result) {
                $s_no_desc = S_info::orderby('s_no', 'desc')->first(); // 내림차순 정렬
                $s_no = $s_no_desc->s_no; // s_no

                $data01['s_parking'] = $req->s_parking;
                $data01['s_ele'] = $req->s_ele;
                $data01['s_no'] = $s_no;
                State_option::create($data01); // 건물 옵션 insert
                //***********TODO : transaction 추가하기!!!!!!!! 2번

                // photo start -----------------------------------
                // $photos = $req->file('photo'); // del 0626 jy

                //파일 선택이 안 된 경우
                // if (!$photos) {
                //     return redirect()->back()->withErrors([
                //         'error' => 'No photos selected'
                //     ]);
                // }
                // $photos = is_array($photos) ? $photos : [$photos]; //del 0625 jy

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

                    // return redirect()->route('stat.option.post');// del 0625 jy
                    // return redirect()->back()->with([
                    //     'status' => '이미지 업로드 성공!'
                    //     ]); // del 0625 jy
                    // return redirect()->back()->with(['status' => '매물 업로드 성공!']); // update 0625 jy

                    // *****************TODO : begin transaction create 밑에 다 몰아서하기
                    return redirect()->route('struct.detail', ['s_no' => $s_no])->with('data01',$data01);
                }
            } else {
                return redirect()->back()->with(['insert_err' => '정보 등록에 실패했습니다']);
            }
            // add 0625 end jy
        }
    }
}
// }
