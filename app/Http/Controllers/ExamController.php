<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Standardize_question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $dataValidate = $request->validate(
            [
                'content' => 'required',
                'password' => 'required|same:confirm_password',
                'opening_time' => 'required',
                'closing_time' => 'required',
                'duration' => 'required',
                'subjects_id' => 'required',
                'status' => 'required',
            ],
            [
                'content.required' => 'Vui lòng nhập nội dung bài thi',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'opening_time.required' => 'Vui lòng nhập thời gian bắt đầu',
                'closing_time.required' => 'Vui lòng nhập thời gian kết thúc',
                'duration.required' => 'Vui lòng nhập thời gian làm bài',
                'subjects_id.required' => 'Vui lòng chọn môn học',
                'status.required' => 'Vui lòng chọn trạng thái',
                'password.same' => 'Mật khẩu không trùng khớp',
            ]
        );

        $exam = new Exam();
        $exam->content = $dataValidate['content'];
        $exam->max_questions = $this->getTotalQuestions($dataValidate['questionsByLevel']);
        $exam->password = $dataValidate['password'];
        $exam->opening_time = $dataValidate['opening_time'];
        $exam->closing_time = $dataValidate['closing_time'];
        $exam->duration = $dataValidate['duration'];
        $exam->subjects_id = $dataValidate['subjects_id'];
        $exam->status = $dataValidate['status'];
        $exam->save();

        $questions = $request->input('questions');
        $exam->standardize_questions()->attach($questions);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
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

        foreach ($counts as $levelId => $count) {
            $questionsByLevel[$levelId] = Question::where('level_id', $levelId)
                ->where('subject_id', $subjectId)
                ->inRandomOrder()
                ->limit($count)
                ->get();
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
}
