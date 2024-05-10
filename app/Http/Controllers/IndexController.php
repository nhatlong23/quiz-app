<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classs;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\StandardizeQuestion;
use Illuminate\Support\Facades\Session;
use App\Models\Blog;
use App\Models\ResultQuestion;

use Illuminate\Support\Facades\Hash;
use App\Models\Result;

class IndexController extends Controller
{
    public function homepage()
    {
        $blogs = Blog::orderBy('id', 'desc')->where('status', '1')->take(3)->get();
        return view('pages.index', compact('blogs'));
    }

    public function loadMoreBlogs(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 3;

        $blogs = Blog::orderBy('id', 'desc')
            ->where('status', '1')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($blogs);
    }

    public function redirectToExam($class_id)
    {
        $class = Classs::find($class_id);
        $exams = $class->standardizeExams;

        $student_id = Auth::guard('students')->user()->id;

        $submittedExams = Result::where('students_id', $student_id)->pluck('exam_id')->toArray();

        return view('pages.exam', compact('exams', 'submittedExams'));
    }

    public function checkPasswordExam(Request $request)
    {
        $password = $request->password;
        $exam_id = $request->exam_id;
        $student_id = Auth::guard('students')->user()->id;

        if (!$password) {
            return response()->json(['valid' => false, 'error' => 'Vui lòng nhập mật khẩu'], 422);
        }

        $exam = Exam::find($exam_id);
        if ($exam && Hash::check($password, $exam->password)) {
            Session::put('exam_password_' . $exam_id . 'student_id_' . $student_id, $password);

            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false, 'error' => 'Mật khẩu không đúng'], 422);
        }
    }

    public function testExam(Request $request, $exam_id)
    {
        $examId = $request->exam_id;
        $questions = StandardizeQuestion::where('exam_id', $examId)->get();
        $totalQuestions = $questions->count();
        $question_duration = $questions->first();
        $exam = Exam::findOrFail($examId);

        return view('pages.question', compact('questions', 'totalQuestions', 'question_duration', 'exam'));
    }

    public function submitAnswers(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $student_id = $request->input('student_id');

        $existingResult = Result::where('exam_id', $exam_id)
            ->where('students_id', $student_id)
            ->exists();

        if ($existingResult) {
            if (Session::has('exam_password_' . $exam_id . 'student_id_' . $student_id)) {
                Session::forget('exam_password_' . $exam_id . 'student_id_' . $student_id);
            }

            return response()->json([
                'success' => false,
                'message' => 'You have already submitted this exam.'
            ]);
        }

        $answers = $request->input('answers');

        // Lưu câu trả lời cho từng câu hỏi
        foreach ($answers as $question_id => $answer) {
            // Lưu câu trả lời vào cơ sở dữ liệu
            $resultQuestion = new ResultQuestion();
            $resultQuestion->question_id = $question_id;
            $resultQuestion->students_id = $student_id;
            $resultQuestion->exam_id = $exam_id;
            $resultQuestion->selected_option = $answer;
            $resultQuestion->is_correct = ($answer !== 'no_answer') ? ($answer == Question::find($question_id)->answer) : false;
            $resultQuestion->created_at = now('Asia/Ho_Chi_Minh');
            $resultQuestion->save();
        }

        // Tính điểm và lưu vào bảng Result
        $correct_answers = ResultQuestion::where('students_id', $student_id)
            ->where('exam_id', $exam_id)
            ->where('is_correct', true)
            ->count();
        $total_questions = count($answers);
        $score = ($correct_answers / $total_questions) * 10;

        $result = new Result();
        $result->students_id = $student_id;
        $result->exam_id = $exam_id;
        $result->point = $score;
        $result->status = '1';
        $result->created_at = now('Asia/Ho_Chi_Minh');
        $result->save();

        return response()->json([
            'success' => true,
            'message' => 'Answers submitted successfully.',
            'score' => $score
        ]);
    }

    public function profile(Request $request)
    {
        return view('pages.profile');
    }

    public function save_profile(Request $request)
    {
        //
    }

    public function history_exam(Request $request)
    {
        $student_id = Auth::guard('students')->user()->id;
        $result = Result::where('students_id', $student_id)->get();
        return view('pages.history_exam', compact('result'));
    }

    public function detailExamHistory(Request $request, $id)
    {
        $result = Result::findOrFail($id);
        $resultQuestions = ResultQuestion::where('students_id', $result->students_id)
            ->where('exam_id', $result->exam_id)
            ->get();
        return view('pages.detail_exam_history', compact('result', 'resultQuestions'));
    }

    public function knowledge()
    {
        return view('pages.knowledge');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function blog_detail($slug)
    {
        $blogs = Blog::where('slug', $slug)->where('status', '1')->first();
        return view('pages.blog_detail', compact('blogs'));
    }
}
