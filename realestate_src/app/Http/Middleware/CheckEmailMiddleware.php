<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckEmailMiddleware
{
    public function handle($request, Closure $next)
    {
        // 세션에서 이메일 확인
        $email = Session::get('email');

        // 이메일이 없는 경우
        if (!$email) {
            abort(403, '이메일이 필요합니다.'); // 예외 발생 또는 다른 처리 가능
        }

        // 이메일이 있는 경우 다음 미들웨어로 이동하거나 요청 처리 계속하기
        return $next($request);
    }
}
