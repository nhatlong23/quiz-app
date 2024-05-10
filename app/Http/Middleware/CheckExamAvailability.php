<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Standardize_Exam;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckExamAvailability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $classId = Auth::guard('students')->user()->student_class->id;

        // Kiểm tra xem lớp có đề thi không
        $examIds = Standardize_Exam::where('class_id', $classId)->pluck('exam_id')->toArray();

        if (empty($examIds)) {
            return redirect()->back()->with('error', 'Lớp không có đề thi.');
        }

        // Lấy id của đề thi từ route
        $requestedExamId = $request->route('exam_id');

        // Kiểm tra xem đề thi được yêu cầu có tồn tại trong lớp hay không
        if (!in_array($requestedExamId, $examIds)) {
            return redirect()->back()->with('error', 'Đề thi không tồn tại trong lớp.');
        }

        return $next($request);
    }
    
}
