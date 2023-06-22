<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPassController extends Controller
{
    public function findUsername(Request $request)
    {
        $db_answer = $request->input('pw_answer');
        $user = User::where('pw_answer', $db_answer)->first();

        if ($user) {
            $request->session()->put('password', $user->password);
            return view('welcome', ['userpass' => $user->userpass, 'password' => $user->passwrod]);
        } else {
            $request->session()->forget('psswrod');
            return view('auth.username-result', ['userpass' => '비밀번호를 찾을 수 없습니다.']);
        }
    }
}
