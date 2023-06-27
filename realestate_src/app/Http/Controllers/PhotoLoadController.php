<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoLoadController extends Controller
{
    public function index()
    {
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
        $updatePhoto = 3;
        $searchQuery = $request->input('search');

        $query = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
            ->where('mvp_photo', '1')
            ->orderBy('photos.updated_at', 'desc');

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('s_infos.s_stai', 'LIKE', "%{$searchQuery}%") // 도로명 주소 검색 조건 추가
                    ->orWhere('s_infos.s_add', 'LIKE', "%{$searchQuery}%"); // 주소 검색 조건 추가
            });
        }

        $photos = $query->skip($lastPhotoId)
            ->take($updatePhoto)
            ->get();

        $lastPhotoId = $lastPhotoId + $updatePhoto;

        return response()->json(['photos' => $photos, 'lastPhotoId' => $lastPhotoId]);
    }
}
