<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class FacebookController extends Controller
{
    public function facebookpage(){
    return Socialite::driver('facebook')->redirect();
    }
    public function facebookredirect()
{
    $user = Socialite::driver('facebook')->user();
    $finduser = User::where('facebook_id', $user->email)->first();

    if ($finduser) {
        Auth::login($finduser);
        session(['u_id' => $finduser->u_id, 'id' => $finduser->id]);
        return redirect('/welcome');
    } else {
        $newUser = User::updateOrCreate([
            'email' => $user->email,
            'name' => '회원',
            'u_id' => $user->email,
            'facebook_id' => $user->email,
            'password' => encrypt('!D123456dummy'),
            'phone_no' => '01012341234',
            'u_addr' => '대구 광역시 강남구 서초동',
            'pw_answer' => '없음',
        ]);

        Auth::login($newUser);
        session(['u_id' => $newUser->u_id, 'id' => $newUser->id]);
        return redirect()->intended('welcome');
    }
}

}
