<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserPassInput extends Controller
{
    public $email;
    public $phone_no;
    public $pw_question;

    public function findUserPwQuestion(Request $request)
    {
        $email=$request->input('email');
        $phone_no=$request->input('phone_no');

        $user = User::where('email', $email)
        ->where('phone_no', $phone_no)
        ->first();

        if ($user) {
            Log::debug('DB : User Table', [$user->email]);
        Log::debug('Question int to String Start');
            $pwQuestionFlag = $user->pw_question;

            switch ($pwQuestionFlag) {
                case 0:
                    $this->pw_question = '나의 어릴적 꿈은?';
                    break;
                case 1:
                    $this->pw_question = '나의 가장 소중한 보물은?';
                    break;
                case 2:
                    $this->pw_question = '나의 가장 슬펐던 기억은?';
                    break;
                case 3:
                    $this->pw_question = '나와 가장 친한 친구는?';
                    break;
                case 4:
                    $this->pw_question = '나의 첫번째 직장의 이름은?';
                    break;
                default:
                    $this->pw_question = '';
                    break;
            }

            $request->session()->put('pw_question', $this->pw_question);
            $request->session()->put('email', $user->email);
            Log::debug('Question int to String End', [$this->pw_question]);

            return view('find-userpass');
        } else {
            Log::debug('Error : No User data');
            Session::flash('error_message', '사용자를 찾을 수 없습니다.');
            return redirect()->route('find-userpassinput');
        }
    }

    public function render()
    {
        return view('find-userpassinput');
    }
}
