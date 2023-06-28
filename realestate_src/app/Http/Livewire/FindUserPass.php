<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;



class FindUserPass extends Component
{
    public $pw_question;
    public $pw_answer;

    public function mount()
    {
        $this->pw_question = '';
        $this->pw_answer = '';
    }

    public function findUserPwAnswer(Request $request)
    {
        $email = session('email');

        $user = User::where('email', $email)->first();

            if ($this->pw_answer === $user->pw_answer) {
                return redirect()->route('password-reset');
            }
            else {
                Session::flash('error_message', '입력한 답변이 일치하지 않습니다.');
                $this->pw_answer = '';
            }
    }

    public function render()
    {
        return view('livewire.find-userpass');
    }
}
