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
use App\Mail\SendContactMail;
use Illuminate\Support\Facades\Mail;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Support\Facades\Hash;
use App\Models\Result;

class IndexController extends Controller
{
    public function homepage()
    {
        $blogs = Blog::orderBy('id', 'desc')->where('status', '1')->take(6)->get();
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
        $validateData = $request->validate([
            'name' => 'required|string',
            'cccd' => 'required|numeric',
            'phone' => 'required|regex:/^0[0-9]{9}$/|numeric',
            'birth' => 'required|date',
            'gender' => 'required',
            'images' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.string' => 'Họ tên không hợp lệ',
            'cccd.required' => 'Vui lòng nhập số CCCD',
            'cccd.numeric' => 'Số CCCD không hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'birth.required' => 'Vui lòng nhập ngày sinh',
            'birth.date' => 'Ngày sinh không hợp lệ',
            'gender.required' => 'Vui lòng chọn giới tính',
            'images.mimes' => 'Hình ảnh không hợp lệ',
            'images.max' => 'Hình ảnh không được vượt quá 10MB',
        ]);

        $student = Auth::guard('students')->user();

        if (
            $student->name != $validateData['name'] ||
            $student->cccd != $validateData['cccd'] ||
            $student->birth != $validateData['birth'] ||
            $student->gender != $validateData['gender'] ||
            $request->hasFile('images')
        ) {

            $student->fill($validateData);
            $student->updated_at = now('Asia/Ho_Chi_Minh');

            if ($request->hasFile('images')) {
                $this->handleImage($request, $student);
            }

            $student->save();

            toastr()->success('Cập nhật thông tin thành công');
        } else {
            toastr()->info('Không có thay đổi để cập nhật');
        }

        return redirect()->route('profile');
    }


    private function handleImage($request, $student)
    {
        $get_image = $request->file('images');

        if ($get_image) {
            if ($student->images) {
                $public_id_old = $student->images;
                $token = explode('/', $public_id_old);
                $token2 = explode('.', $token[sizeof($token) - 1]);
                Cloudinary::destroy('students/' . $token2[0]);
            }

            $original_name = $get_image->getClientOriginalName();
            $public_id_new = pathinfo($original_name, PATHINFO_FILENAME);

            $uploadedImage = Cloudinary::upload($get_image->getRealPath(), [
                'folder' => 'quizz_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => $public_id_new,
            ]);

            $student->images = $uploadedImage->getSecurePath();
        }
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

    public function sendContactEmail(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'message' => 'required',
        // ]);

        // $name = $request->input('name');
        // $email = $request->input('email');
        // $message = $request->input('message');

        // Mail::to('nhatlong2356@gmail.com')->send(new SendContactMail($name, $email, $message));

        return redirect()->back()->with('success', 'Email sent successfully!');
    }

    public function blog_detail($slug)
    {
        $blogs = Blog::where('slug', $slug)->where('status', '1')->firstOrFail();
        $relatedPosts = $blogs->relatedPosts();

        $show_tags = explode(',', $blogs->tags);
        $filtered_tags = array_filter($show_tags);

        return view('pages.blog_detail', compact('blogs', 'relatedPosts', 'filtered_tags'));
    }

    public function tags($tags)
    {
        $blogs = Blog::where('tags', 'like', '%' . $tags . '%')
            ->orWhere('title', 'like', '%' . $tags . '%')
            ->where('status', '1')
            ->get();

        return view('pages.tags', compact('blogs', 'tags'));
    }
}
