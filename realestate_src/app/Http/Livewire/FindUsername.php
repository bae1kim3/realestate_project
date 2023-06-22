<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class FindUsername extends Component
{
    public $email;
    public $u_id;

    public function mount()
    {
        $this->email = '';
        $this->u_id = '';
    }

    public function findUsername()
    {
        $user = User::where('email', $this->email)->first();

        if ($user) {
            $this->u_id = $user->u_id;
            return redirect()->route('login')->with('u_id', $user->u_id);
        } else {
            session()->flush();
            return redirect()->route('find-username');
        }
    }

    public function render()
    {
        return view('livewire.find-username');
    }
}
