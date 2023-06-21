<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserPassInput extends Component
{
    public $email;
    public $phone_no;
    public $pw_question;

    public function mount()
    {
        $this->email = '';
        $this->phone_no = '';
        $this->pw_question = '';
    }

    public function findUserPwQuestion(Request $request)
    {
        $user = User::where('email', $this->email)
            ->where('phone_no', $this->phone_no)
            ->first();

        if ($user) {
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

            return redirect()->route('find-userpass');
        } else {
            Session::flash('error_message', '사용자를 찾을 수 없습니다.');
        }
    }

    public function render()
    {
        return view('livewire.find-userpassinput');
    }
}
