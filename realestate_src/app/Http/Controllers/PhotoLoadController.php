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
    $photos = Photo::where('mvp_photo', '1')
        ->orderBy('created_at', 'desc')
        ->take($lastPhotoId)
        ->get();
    return view('/welcome')->with('photos', $photos)->with('lastPhotoId', $lastPhotoId);
}

public function loadMorePhotos(Request $request)
{
    $lastPhotoId = $request->lastPhotoId;
    $updatePhoto = 3;

    $photos = Photo::where('mvp_photo', '1')
        ->orderBy('created_at', 'desc')
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
