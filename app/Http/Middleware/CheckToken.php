<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        // تحقق من وجود التوكن في الجلسة
        $token = session('auth_token');

        if (!$token) {
            return redirect()->route('login.page')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
