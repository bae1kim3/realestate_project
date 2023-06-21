<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoLoadController extends Controller
{
    public function index()
{
    $photos = Photo::orderBy('created_at', 'desc')->take(1)->get();
    return view('/welcome')->with('photos', $photos);
}
public function loadMorePhotos(Request $request)
{
    $lastPhotoId = $request->lastPhotoId;
    $photos = Photo::where('p_no', '>', $lastPhotoId)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return response()->json(['photos' => $photos]);
}


    public function searchPhotos(Request $request)
    {

    }
}
