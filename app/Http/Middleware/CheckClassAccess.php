<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClassAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $classId = $request->route('class_id');
        // Kiểm tra xem người dùng đã đăng nhập và là thí sinh hay không
        if (Auth::guard('students')->check()) {
            // Lấy id của lớp học của thí sinh đang đăng nhập
            $userClassId = Auth::guard('students')->user()->class_id;

            // Kiểm tra xem thí sinh có quyền truy cập vào lớp học hay không
            if ($classId != $userClassId) {
                // Nếu không, chuyển hướng hoặc trả về thông báo lỗi
                return redirect()->route('homepage')->with('error', 'Bạn không có quyền truy cập vào lớp học này.');
            }
        }

        return $next($request);
    }
}