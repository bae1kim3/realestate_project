<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class EmailVerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::find($id);

        if ($user && hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                event(new Verified($user));
            }
        }
        Auth::logout();
        Session::forget('url');
        return redirect('/login');
    }
}
