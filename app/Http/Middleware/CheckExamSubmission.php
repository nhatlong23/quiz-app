<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Result;

class CheckExamSubmission
{
    public function handle(Request $request, Closure $next)
    {
        $exam_id = $request->route('exam_id');
        $student_id = auth()->id();

        // Kiểm tra xem sinh viên đã làm đề thi đó hay chưa
        $existingResult = Result::where('exam_id', $exam_id)
            ->where('students_id', $student_id)
            ->exists();

        // Nếu đã nộp bài, chuyển hướng về trang chủ và hiển thị thông báo
        if ($existingResult) {
            return redirect()->route('homepage')->with('error', 'Bạn đã nộp bài cho đề thi này.');
        }

        // Nếu chưa nộp bài, tiếp tục xử lý tiếp theo
        return $next($request);
    }
}
