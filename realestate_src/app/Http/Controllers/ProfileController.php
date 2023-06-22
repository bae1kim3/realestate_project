<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function verifyPhoneNumber(Request $request)
{
    $inputPhoneNo = $request->phone_no;
    $user_id=session('u_id');

    $user = User::where('phone_no', $inputPhoneNo)
                    ->where('u_id',$user_id)->first();

    if ($user) {
        return redirect()->route('up_pass');
    } else {
        return back()->withErrors(['phone_no' => 'Phone number does not match.'])->withInput();
    }
}

    public function UpdatePassPost(Request $request){
        $inputPhoneNo = $request->phone_no;
        $user_id=session('u_id');

    $user = User::where('phone_no', $inputPhoneNo)
                    ->where('u_id',$user_id)->first();

    if ($user) {
        return view('profile.up_pass');
    } else {
        return back()->withErrors(['phone_no' => 'Phone number does not match.'])->withInput();
    }
    }
}
