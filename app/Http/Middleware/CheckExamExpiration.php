<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Exam;

class CheckExamExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $exam_id = $request->route('exam_id');

        // Lấy thông tin về đề thi từ cơ sở dữ liệu
        $exam = Exam::findOrFail($exam_id);

        // Định dạng thời gian hiện tại
        $current_time = now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $opening_time = $exam->opening_time;
        $closing_time = $exam->closing_time;

        // So sánh thời gian hiện tại với thời gian mở và kết thúc của đề thi
        if ($current_time < $opening_time) {
            return redirect()->route('homepage')
                ->with('error', 'Đề thi chưa mở. Vui lòng quay lại sau ' . $exam->formatted_opening_time . '.');
        }

        if ($current_time > $closing_time) {
            return redirect()->route('homepage')
                ->with('error', 'Đề thi đã đóng. Bạn không thể tham gia bài thi này.');
        }

        return $next($request);
    }
}
