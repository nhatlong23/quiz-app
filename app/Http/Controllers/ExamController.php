<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Classs;
use App\Models\Standardize_Exam;
use App\Models\StandardizeQuestion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams_list = Exam::orderBy('id', 'desc')->get();
        $class_list = Classs::orderBy('id', 'desc')->get();
        return view('admin.exam.index', compact('exams_list', 'class_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::orderBy('id', 'desc')->get();
        $levels = Level::orderBy('id', 'asc')->get();
        return view('admin.exam.form', compact('subjects', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'content' => 'required|unique:exam',
            'password' => 'required|same:confirm_password',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'duration' => 'required',
            'randomQuestions' => 'required',
            'max_questions' => 'required',
            'subjectId' => 'required',
        ], [
            'content.required' => 'Vui lòng nhập nội dung bài thi',
            'content.unique' => 'Nội dung bài thi đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'opening_time.required' => 'Vui lòng nhập thời gian bắt đầu',
            'closing_time.required' => 'Vui lòng nhập thời gian kết thúc',
            'duration.required' => 'Vui lòng nhập thời gian làm bài',
            'password.same' => 'Mật khẩu không trùng khớp',
            'randomQuestions.required' => 'Vui lòng chọn câu hỏi ngẫu nhiên',
            'max_questions.required' => 'Vui lòng chọn số lượng câu hỏi',
            'subjectId.required' => 'Vui lòng chọn môn học',
        ]);

        $hashedPassword = Hash::make($dataValidate['password']);

        $exam = new Exam();
        $exam->content = $dataValidate['content'];
        $exam->password = $hashedPassword;
        $exam->opening_time = $dataValidate['opening_time'];
        $exam->closing_time = $dataValidate['closing_time'];
        $exam->duration = $dataValidate['duration'];
        $exam->max_questions = $dataValidate['max_questions'];
        $exam->subjects_id = $dataValidate['subjectId'];
        $exam->status = 1;
        $exam->created_at = now('Asia/Ho_Chi_Minh');
        $exam->save();

        // Lưu câu hỏi ngẫu nhiên cho bài thi
        $randomQuestions = json_decode($request->input('randomQuestions'), true);
        foreach ($randomQuestions as $levelId => $questions) {
            foreach ($questions as $question) {
                $standardizeQuestion = new StandardizeQuestion();
                $standardizeQuestion->exam_id = $exam->id;
                $standardizeQuestion->questions_id = $question['id'];
                $standardizeQuestion->created_at = now('Asia/Ho_Chi_Minh');
                $standardizeQuestion->save();
            }
        }

        return response()->json(['success' => 'Bài thi đã được lưu thành công.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $subjects = Subject::orderBy('id', 'desc')->get();
        $levels = Level::orderBy('id', 'asc')->get();
        return view('admin.exam.form', compact('exam', 'subjects', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataValidate = $request->validate([
            'content' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'duration' => 'required',
        ], [
            'content.required' => 'Vui lòng nhập nội dung bài thi',
            'opening_time.required' => 'Vui lòng nhập thời gian bắt đầu',
            'closing_time.required' => 'Vui lòng nhập thời gian kết thúc',
            'duration.required' => 'Vui lòng nhập thời gian làm bài',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->fill($dataValidate);
        $exam->updated_at = now('Asia/Ho_Chi_Minh');
        $exam->save();

        return redirect()->route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);

        if (!$exam) {
            toastr()->error('Bài thi không tồn tại');
            return redirect()->route('exams.index');
        }

        $deletedQuestions = StandardizeQuestion::where('exam_id', $exam->id)->delete();

        // if (!$deletedQuestions) {
        //     toastr()->error('Không thể xóa câu hỏi liên quan đến bài thi');
        //     return redirect()->route('exams.index');
        // }

        $exam->delete();

        toastr()->success('Xóa bài thi và các câu hỏi liên quan thành công');
        return redirect()->route('exams.index');
    }

    public function ExamRequest(Request $request)
    {
        $subjectId = $request->input('subject');
        $counts = $request->input('counts');

        $questionsByLevel = $this->getQuestionsByLevel($subjectId, $counts);
        $totalQuestions = $this->getTotalQuestions($questionsByLevel);

        return response()->json([
            'questionsByLevel' => $questionsByLevel,
            'totalQuestions' => $totalQuestions
        ]);
    }

    private function getQuestionsByLevel($subjectId, $counts)
    {
        $questionsByLevel = [];

        if ($counts !== null) {
            foreach ($counts as $levelId => $count) {
                $questionsByLevel[$levelId] = Question::where('level_id', $levelId)
                    ->where('subject_id', $subjectId)
                    ->inRandomOrder()
                    ->limit($count)
                    ->get();
            }
        }

        return $questionsByLevel;
    }

    private function getTotalQuestions($questionsByLevel)
    {
        $totalQuestions = 0;
        foreach ($questionsByLevel as $questions) {
            $totalQuestions += count($questions);
        }

        return $totalQuestions;
    }

    public function deleteQuestionFromExam(Request $request)
    {
        $questionId = $request->input('question_id');
        $examId = $request->input('exam_id');

        $standardizeQuestion = StandardizeQuestion::where('exam_id', $examId)
            ->where('questions_id', $questionId)
            ->first();

        if ($standardizeQuestion) {
            $standardizeQuestion->delete();
            $remainingQuestionsCount = StandardizeQuestion::where('exam_id', $examId)->count();

            $exam = Exam::findOrFail($examId);
            $exam->max_questions = $remainingQuestionsCount;
            $exam->updated_at = now('Asia/Ho_Chi_Minh');
            $exam->save();

            return response()->json(['message' => 'Xoá câu hỏi thành công', 'remainingQuestionsCount' => $remainingQuestionsCount]);
        } else {
            return response()->json(['message' => 'Không tìm thấy câu hỏi hoặc đề thi tương ứng'], 404);
        }
    }


    public function quick_view_exam(Request $request)
    {
        $exam_id = $request->id_exam;
        $subject_id = $request->subjects_id;

        $exam = Exam::findOrFail($exam_id);
        $subject = Subject::findOrFail($subject_id);
        $questions = $exam->questions;

        $output = [
            'content' => $exam->content,
            'subject' => $subject->name,
            'questions' => $questions,
        ];

        return response()->json($output);
    }

    public function addExamToClass(Request $request)
    {
        $classId = $request->class_id;
        $examId = $request->exam_id;

        $existingRecord = Standardize_Exam::where('class_id', $classId)
            ->where('exam_id', $examId)
            ->first();

        if ($existingRecord) {
            return response()->json(['success' => false, 'message' => 'Đề thi này đã được thêm vào lớp.']);
        }

        $standardizedExam = new Standardize_Exam();
        $standardizedExam->class_id = $classId;
        $standardizedExam->exam_id = $examId;
        $standardizedExam->created_at = now('Asia/Ho_Chi_Minh');
        $standardizedExam->save();

        return response()->json(['success' => true, 'message' => 'Đã thêm đề thi vào lớp thành công.']);
    }

    public function updateStatusExams(Request $request)
    {
        $exam = Exam::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $exam->status = $status;
        $exam->updated_at = now('Asia/Ho_Chi_Minh');
        $exam->save();

        return $status;
    }
}
