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
    return view('/welcome')->with('photos', $photos)->with('lastPhotoId', $lastPhotoId);
}

public function loadMorePhotos(Request $request)
{
    $lastPhotoId = $request->lastPhotoId;
    $updatePhoto = 3;

    $photos = Photo::join('s_infos', 's_infos.s_no', 'photos.s_no')
        ->where('mvp_photo', '1')
        ->orderBy('photos.updated_at', 'desc')
        ->skip($lastPhotoId)
        ->take($updatePhoto)
        ->get();
    $lastPhotoId = $lastPhotoId + $updatePhoto;
        return response()->json(['photos' => $photos, 'lastPhotoId' => $lastPhotoId]);
}


    public function searchPhotos(Request $request)
    {

    }
}
