<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CheckExamPassword
{
    public function handle(Request $request, Closure $next)
    {
        $requestedExamId = $request->route('exam_id');
        $student_id = Auth::guard('students')->user()->id;

        // Kiểm tra xem mật khẩu đã được lưu trong session hay không
        $savedPassword = Session::get('exam_password_' . $requestedExamId . 'student_id_' . $student_id);

        // Nếu mật khẩu đã được lưu hoặc người dùng đã xác thực mật khẩu từ trước
        if ($savedPassword || $this->checkPassword($request)) {
            return $next($request);
        }

        // Nếu không có mật khẩu hoặc người dùng chưa xác thực, chuyển hướng đến trang yêu cầu nhập mật khẩu
        return redirect()->back()->with('error', 'Vui lòng nhập mật khẩu để tiếp tục');
    }

    // Hàm này sẽ gọi hàm checkPasswordExam từ controller và kiểm tra kết quả trả về
    private function checkPassword($request)
    {
        $response = app()->call([$request->route()->getController(), 'checkPasswordExam'], ['request' => $request]);
        return $response->getData()->valid;
    }
}
