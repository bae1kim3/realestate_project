<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * 
     * @var bool
     * 
     */
    protected $addHttpCookie = true;

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('P3P', 'CP="IDC DSR COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
        return $response;
    }
    /**
     * The URIs that should be excluded from CSRF verification.
     * 
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
