<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function resetps()
    {
        return view('password-reset');
    }
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ], [
            'password.confirmed' => '비밀번호 확인이 일치하지 않습니다.',
        ]);

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->withErrors(['password' => '비밀번호 확인이 일치하지 않습니다.'])->withInput();
        }

        $user = User::where('email', session('email'))->first();
        if (!$user) {
            return redirect()->back()->withErrors(['password' => '유효하지 않은 사용자입니다.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->put('success', '비밀번호 변경이 완료되었습니다. 로그인해주세요.');

        return redirect()->route('login');
    }
}
