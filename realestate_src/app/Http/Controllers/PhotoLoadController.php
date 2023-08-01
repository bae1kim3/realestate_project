<?php
namespace App\Http\Controllers;

use App\Models\Jjim;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\S_info;
use Illuminate\Support\Facades\Log;

class PhotoLoadController extends Controller
{
    public function index()
    {
        // 처음 페이지 진입 했을 때 출력시킬 사진 갯수
        $lastPhotoId = 17;
        $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc')
            ->take($lastPhotoId)
            ->get();

        $liked_info = [];

        // 찜
        if(Auth::check()) {
            if(session('seller_license')== null) {
                $id = Auth::user()->id;
                // $liked_list = Jjim::where('id', $id)->select('s_no')->take(10)->get();
                $liked_list = Jjim::where('id', $id)->pluck('s_no')->toArray();

                // $liked_list = Jjim::join('photos', 'photos.s_no', 'jjims.s_no')
                // ->where('id', $id)->where('mvp_photo', '1')
                // ->take(10)
                // ->get();
                // $liked_s_info =

                $liked_info = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
                ->where('mvp_photo', '1')
                ->whereIn('photos.s_no', $liked_list)
                ->orderBy('photos.updated_at', 'desc')
                ->take(10)
                ->get();
            }



        }


        $building = S_info::orderBy('hits', 'desc')->first();

        $s_no = $building ? $building->s_no : null;

        $photo = Photo::where('s_no', $s_no)->where('mvp_photo', 1)->first();

        return view('welcome', compact('photos', 'lastPhotoId', 'liked_info','photo','building'));
    }

    // public function loadMorePhotos(Request $request)
    // {
    //     $lastPhotoId = $request->lastPhotoId;
    //     $updatePhoto = 5;
    //     $search = $request->input('search');

    //     $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
    //         ->where('mvp_photo', '1')
    //         ->orderBy('photos.updated_at', 'desc');

    //     // 검색기능
    //     if (!empty($search)) {
    //         $query->where(function ($query) use ($search) {
    //             $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
    //                 ->orWhere('s_infos.s_add', 'LIKE', "%{$search}%"); // 도로명 주소 검색
    //         $lastPhotoId = 0;
    //         });
    //     }

    //     $photos = $query->skip($lastPhotoId)
    //         ->take($updatePhoto)
    //         ->get();

    //     // 여태까지 출력된 사진의 총 갯수
    //     $lastPhotoId = $lastPhotoId + $updatePhoto;

    //     return response()->json(['photos' => $photos, 'lastPhotoId' => $lastPhotoId]);
    // }


    public function loadMorePhotos(Request $request)
    {
        // //검색 키워드 들고오기
        // $search = $request->input('search');

        // // 대형동물, 거래유형(월, 전, 매)
        // //mvp_photo 1 의 s_infos + photos 정보 들고오기
        
        // $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
        //     ->where('mvp_photo', '1')
        //     ->orderBy('photos.updated_at', 'desc');

        // // 검색기능
        //     $query->where(function ($query) use ($search) {
        //         $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
        //             ->orWhere('s_infos.s_add', 'LIKE', "%{$search}%"); // 도로명 주소 검색
        //     });

        // $searchCount = $query->count();
        // $photos = $query->take($searchCount)->get(); // 검색 정보 들고옴

        // return response()->json(['photos' => $photos]);
    }

    // 검색 리스트 페이지
    public function checkBoxGet(Request $request) {
        $requestArray = [];
        array_push($requestArray, $request->p_month, $request->p_jeonse, $request->p_sell);
        // null 값 없는것만 p_type에 담음
        $p_type = [];
        foreach($requestArray as $val) {
            if($val != null) {
                array_push($p_type, $val);
            }
        }
        
        if($request->input('search') !== null) {
            $search = $request->input('search');
            $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc')
            ->when(isset($request->animal_size), function($query) {
                return $query->where('animal_size', '1');
            })
            ->when(!empty($p_type), function($query) use ($p_type) {
                return $query->whereIn('s_type', $p_type);
            });
            
            $query->where(function ($query) use ($search) {
                $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
                ->orWhere('s_infos.s_add', 'LIKE', "{$search}%"); // 도로명 주소 검색
            });
            $chk_search = $query->get();
        }
        else {
            $search = $request->input('search');
            $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
                    ->where('mvp_photo', '1')
                    ->orderBy('photos.updated_at', 'desc')
                    ->when(isset($request->animal_size), function($query) {
                        return $query->where('animal_size', '1');
                    })
                    ->when(!empty($p_type), function($query) use ($p_type) {
                        return $query->whereIn('s_type', $p_type);
                    });
                $chk_search = $query->get();
            }
            
            return view('searchPage')->with('chk_search', $chk_search);

            //검색 키워드 들고오기
            // if($request->input('search') ==! null){
                
            //     $search = $request->input('search');
            //     $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            //             ->where('mvp_photo', '1')
            //             ->orderBy('photos.updated_at', 'desc')
            //             ->when(isset($request->animal_size), function($query) {
            //                 return $query->where('animal_size', '1');
            //             })
            //             ->when($request->p_type == '월세', function($query) {
            //                 return $query->where('s_type', '월세');
            //             })
            //             ->when($request->p_type == '전세', function($query) {
            //                 return $query->where('s_type', '전세');
            //             })
            //             ->when($request->p_type == '매매', function($query) {
            //                 return $query->where('s_type', '매매');
            //             });
            
            //         $query->where(function ($query) use ($search) {
            //             $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
            //                 ->orWhere('s_infos.s_add', 'LIKE', "%{$search}%"); // 도로명 주소 검색
            //         });
            //         $chk_search = $query->get();
            // }
            // else {
            //     $search = $request->input('search');
            //     $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            //             ->where('mvp_photo', '1')
            //             ->orderBy('photos.updated_at', 'desc')
            //             ->when(isset($request->animal_size), function($query) {
            //                 return $query->where('animal_size', '1');
            //             })
            //             ->when($request->p_type == '월세', function($query) {
            //                 return $query->where('s_type', '월세');
            //             })
            //             ->when($request->p_type == '전세', function($query) {
            //                 return $query->where('s_type', '전세');
            //             })
            //             ->when($request->p_type == '매매', function($query) {
            //                 return $query->where('s_type', '매매');
            //             });
            //         $chk_search = $query->get();
            // }
    }

    public function checkBoxPost(Request $request)
    {
        $requestArray = [];
        array_push($requestArray, $request->p_month, $request->p_jeonse, $request->p_sell);
        $p_type = [];
        foreach($requestArray as $val) {
            if($val != null) {
                array_push($p_type, $val);
            }
        }
        if($request->input('search') !== null) {
            $search = $request->input('search');

            // $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            //     ->where('mvp_photo', '1')
            //     ->orderBy('photos.updated_at', 'desc')
            //     ->when(isset($request->animal_size), function($query) {
            //         return $query->where('animal_size', '1');
            //     })
            //     ->when(isset($request->p_month), function($query) {
            //         return $query->orWhere('s_type', '월세');
            //     })
            //     ->when(isset($request->p_jeonse), function($query) {
            //         return $query->orWhere('s_type', '전세');
            //     })
            //     ->when(isset($request->p_sell), function($query) {
            //         return $query->orWhere('s_type', '매매');
            //     });

            $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
                ->where('mvp_photo', '1')
                ->orderBy('photos.updated_at', 'desc')
                ->when(isset($request->animal_size), function($query) {
                    return $query->where('animal_size', '1');
                })
                ->when(!empty($p_type), function($query) use ($p_type) {
                    return $query->whereIn('s_type', $p_type);
                });
    
            $query->where(function ($query) use ($search) {
                $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
                    ->orWhere('s_infos.s_add', 'LIKE', "{$search}%"); // 도로명 주소 검색
            });
            $chk_search = $query->get();
        }
        else {
            $search = $request->input('search');
            $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
                    ->where('mvp_photo', '1')
                    ->orderBy('photos.updated_at', 'desc')
                    ->when(isset($request->animal_size), function($query) {
                        return $query->where('animal_size', '1');
                    })
                    ->when(!empty($p_type), function($query) use ($p_type) {
                        return $query->whereIn('s_type', $p_type);
                    });
                $chk_search = $query->get();
        }
        
        
        return view('searchPage')->with('chk_search', $chk_search);
        
    }
}
