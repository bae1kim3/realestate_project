<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class FindUserPwAnswer extends Component
{
    public $pw_answer;

    public function mount()
    {
        $this->pw_answer='';
    }

    public function findUserPwAnswer()
    {
        $user = User::where('pw_answer', $this->pw_answer)->first();

        if ($user) {

        } else {
            Session::flash('error_message', '답변이 일치하지 않습니다.');
        }
    }

    public function render()
    {
        return redirect()->route('find-userpass.post');
    }
}
