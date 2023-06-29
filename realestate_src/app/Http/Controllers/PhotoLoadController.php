<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoLoadController extends Controller
{
    public function index()
    {
        // 처음 페이지 진입 했을 때 출력시킬 사진 갯수
        $lastPhotoId = 5;
        $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc')
            ->take($lastPhotoId)
            ->get();

        return view('welcome', compact('photos', 'lastPhotoId'));
    }

    public function loadMorePhotos(Request $request)
    {
        $lastPhotoId = $request->lastPhotoId;
        $updatePhoto = 5;
        $search = $request->input('search');

        $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc');

        // 검색기능
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('s_infos.s_stai', 'LIKE', "%{$search}%") //  지하철역 검색
                    ->orWhere('s_infos.s_add', 'LIKE', "%{$search}%"); // 도로명 주소 검색
            $lastPhotoId = 0;
            });
        }

        $photos = $query->skip($lastPhotoId)
            ->take($updatePhoto)
            ->get();

        // 여태까지 출력된 사진의 총 갯수
        $lastPhotoId = $lastPhotoId + $updatePhoto;

        return response()->json(['photos' => $photos, 'lastPhotoId' => $lastPhotoId]);
    }
}