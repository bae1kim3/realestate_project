<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function username()
    {
        return 'u_id';
    }

    protected function redirectPath()
    {
        return '/';
    }

    protected function authenticated(Request $request, $user)
    {
        $seli = User::select('seller_license')->where('u_id', $user->u_id)->first();
        session(['seller_license' => $seli->seller_license, 'u_id' => $user->u_id, 'u_no'=>$user->id]);
    }
}
