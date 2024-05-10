<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('students')->check()) {
            // Nếu đã đăng nhập và đang trên trang đăng nhập, chuyển hướng người dùng đến trang chính
            if ($request->route()->named('redirectToLogin')) {
                return redirect()->route('homepage');
            }
        } else {
            // Nếu chưa đăng nhập và đang không ở trên trang đăng nhập, chuyển hướng người dùng đến trang đăng nhập
            if (!$request->route()->named('redirectToLogin')) {
                return redirect()->route('redirectToLogin');
            }
        }

        return $next($request);
    }
}
