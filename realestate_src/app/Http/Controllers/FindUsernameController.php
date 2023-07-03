<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FindUsernameController extends Controller
{
    public function index()
    {
        return view('find-username');
    }

    public function findUsername(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // 아이디를 찾은 경우
            return response()->json(['user' => $user]);
        } else {
            // 사용자를 찾을 수 없는 경우
            return response()->json(['error' => '사용자를 찾을 수 없습니다.']);
        }
    }
}