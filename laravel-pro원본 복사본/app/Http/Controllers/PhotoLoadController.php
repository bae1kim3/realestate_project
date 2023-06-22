<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoLoadController extends Controller
{
    public function index()
{
    $defaultNum = 5;
    $photos = Photo::where('mvp_photo', '1')
        ->orderBy('created_at', 'desc')
        ->take($defaultNum)
        ->get();
    return view('/welcome')->with('photos', $photos)->with('defaultNum', $defaultNum);
}

public function loadMorePhotos(Request $request)
{
    $lastPhotoId = $request->lastPhotoId;
    $photos = Photo::where('mvp_photo', '1')
        ->orderBy('created_at', 'desc')
        ->skip($lastPhotoId)
        ->take(3)
        ->get();
        
        return response()->json(['photos' => $photos]);
}


    public function searchPhotos(Request $request)
    {

    }
}
