<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginStudentsController extends Controller
{
    public function redirectToLogin()
    {
        return view('pages.login');
    }

    public function checkLoginStudents(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('students')->attempt($credentials)) {
            return redirect()->route('homepage');
        } else {
            toastr()->error('Email hoặc mật khẩu không đúng', 'Lỗi đăng nhập');
            return redirect()->back();
        }
    }

    public function logoutStudents(Request $request)
    {
        $exam_id = $request->route('exam_id');
        Session::forget('exam_password_' . $exam_id);
        Auth::guard('students')->logout();
        return redirect('/');
    }
}
