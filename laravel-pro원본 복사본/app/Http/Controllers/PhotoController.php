<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Models\Photo;


class PhotoController extends Controller
{
    public function store(Request $request){
        $photos = $request->file('photo');

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

if ($totalPhotos < $minPhotos || $totalPhotos > $maxPhotos) {
    return redirect()->back()->withErrors([
        'error' => '사진은 ' . $minPhotos . ' 이상 ' . $maxPhotos . ' 이하로 올려주세요'
    ]);
} else {
    foreach ($photos as $photo) {
        if (!$photo) {
            continue; // 사진이 선택되지 않은 경우 건너뜁니다.
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

            $photo = Photo::create([
                // 's_no'=>
                'url' => Storage::url($path),
                'hashname' => $photo->hashName(),
                'originalname' => $photo->getClientOriginalName()
            ]);
        }

        return redirect()->back()->with([
            'status' => '이미지 업로드 성공!'
            ]);
        }
    }
}
