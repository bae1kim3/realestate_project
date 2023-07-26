<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialController extends Controller
{
    public function redirectToKakao(){
    return Socialite::driver('kakao')->redirect();
    }
    public function facebookpage(){
        return Socialite::driver('facebook')->redirect();
    }
    public function handleKakaoCallback()
{
    $user = Socialite::driver('kakao')->user();
    $email=$user->getEmail();
    $finduser = User::where('email', $email)->first();

    // return var_dump($finduser);
    if ($finduser) {
        Auth::login($finduser);
        session(['u_id' => $finduser->u_id, 'id' => $finduser->id]);
        return redirect('/welcome');
    } else {
            $finduser=new User();
            $finduser->email=$email;
            $finduser->name='회원';
            $finduser->u_id=$email;
            $finduser->kakao_id=$email;
            $finduser->password=encrypt('!D123456dummy');
            $finduser->phone_no='01012341234';
            $finduser->u_addr='대구 광역시 강남구 서초동';
            $finduser->pw_answer='없음';
            $finduser->save();
    }

        Auth::login($finduser);
        session(['u_id' => $finduser->u_id, 'id' => $finduser->id]);
        return redirect()->intended('welcome');
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
            'facebook_id'=>$user->email,
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

