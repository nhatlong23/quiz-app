<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;

class CheckExamSubmission
{
    public function handle(Request $request, Closure $next)
    {
        $exam_id = $request->exam_id;
        $student_id = Auth::guard('students')->user()->id;

        $existingResult = Result::where('exam_id', $exam_id)
            ->where('students_id', $student_id)
            ->exists();

        if ($existingResult) {
            return redirect()->route('homepage')->with('error', 'Bạn đã nộp bài cho đề thi này.');
        }

        return $next($request);
    }
}
