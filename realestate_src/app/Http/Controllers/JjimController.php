<?php

namespace App\Http\Controllers;

use App\Models\Jjim;
use Illuminate\Http\Request;
use App\Models\S_info;
use App\Models\Photo;

class JjimController extends Controller
{
    // public function store()
    // {
    //     $u_no = session('u_no');
    //     $s_no = session('s_no');

    //     $existingJjim = Jjim::where('s_no', $s_no)
    //         ->where('id', $u_no)
    //         ->first();

    //     if ($existingJjim) {
    //         $meg=session()->flash('message', '이미 존재하는 상품입니다.');
    //     } else {
    //         $meg=session()->flash('message', '찜이 완료되었습니다.');
    //     }
    //     return redirect()->back()->with('message',$meg);
    // }

    // 위 내용 del 0720 jy
    // ==> ******** ApiLikedController, jjim.js, sDetail.blade.php, StrunctureDetailController에서 찜기능 구현함!!
}
