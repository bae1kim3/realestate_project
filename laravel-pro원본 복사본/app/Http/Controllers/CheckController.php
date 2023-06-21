<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seller_license_no;

class CheckController extends Controller
{
    public function checkId(Request $request)
    {
        $uId = $request->input('u_id');

        $user = User::where('u_id', $uId)->first();

        if ($user) {
            $message = '이미 사용중인 아이디 입니다.';
            return view('auth.check')->with('error_message', $message);
        } else {
            $message = '사용 가능한 아이디 입니다.';
            return view('auth.check')->with('message', $message)->with('u_id', $uId);
        }
    }

    public function checkLicense(Request $request)
    {
        $sellerLicense = $request->input('seller_license');
        // var_dump($sellerLicense);

        $license = Seller_license_no::where('license_no', $sellerLicense)->first();
        // var_dump($license);

        if ($license) {
            $message = "확인되었습니다.";
            return view('auth.licheck')->with('message', $message);
        } else {
            $message = "존재하지 않는 라이센스 번호 입니다.";
            return view('auth.licheck')->with('error_message', $message)->with('seller_license', $sellerLicense);
        }
    }

}
