<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPassInputController extends Controller
{
    public function userpassinput(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            $request->session()->put('u_id', $user->id);
            return view('welcome', ['username' => $user->username, 'u_id' => $user->id]);
        }
    }

}
