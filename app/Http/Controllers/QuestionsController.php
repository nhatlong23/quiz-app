<?php

namespace App\Http\Controllers;

use App\Imports\QuestionsImport;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Level;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question_list = Question::orderBy('id', 'DESC')->get();
        $subjects = Subject::orderBy('id', 'DESC')->get();
        return view('admin.question.index', compact('question_list', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::orderBy('id', 'ASC')->get();
        $subjects = Subject::orderBy('id', 'DESC')->get();
        return view('admin.question.form', compact('subjects', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'answer' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'subject_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'status' => 'required',
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => 'Mã câu hỏi đã tồn tại',
            'max' => ':Attribute không được quá :max ký tự',
            'numeric' => ':Attribute phải là số',
            'image' => ':Attribute phải là ảnh',
            'mimes' => ':Attribute phải là định dạng jpeg, png, jpg, gif, svg',
            'max' => ':Attribute không được quá :max KB',
        ]);

        $question = new Question();
        $question->fill($validatedData);
        $question->created_at = now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('picture')) {
            $uploadedImage = Cloudinary::upload($request->file('picture')->getRealPath(), [
                'folder' => 'quizz_local/questions',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
            $question->picture = $uploadedImage->getSecurePath();
        }
        $question->save();

        toastr()->success("Thêm thành công Câu hỏi: $question->question");
        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($subjectId)
    {
        $questions = Question::where('subject_id', $subjectId)->get();

        return view('admin.question.show', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $questions = Question::findOrFail($id);
        $subjects = Subject::orderBy('id', 'DESC')->get();
        $levels = Level::orderBy('id', 'ASC')->get();
        return view('admin.question.form', compact('questions', 'subjects', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'answer' => 'required',
            'question' => 'required|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'subject_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'status' => 'required',
        ], [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được quá :max ký tự',
            'numeric' => ':Attribute phải là số',
            'image' => ':Attribute phải là ảnh',
            'mimes' => ':Attribute phải là định dạng jpeg, png, jpg, gif, svg',
            'max' => ':Attribute không được quá :max KB',
        ]);

        $question = Question::findOrFail($id);

        $fields = [
            'answer' => 'Đáp án',
            'question' => 'Câu hỏi',
            'option_a' => 'Đáp án A',
            'option_b' => 'Đáp án B',
            'option_c' => 'Đáp án C',
            'option_d' => 'Đáp án D',
            'status' => 'Trạng thái',
        ];

        foreach ($fields as $field => $label) {
            if ($question->$field != $validatedData[$field]) {
                if ($field === 'status') {
                    $statusText = $validatedData[$field] == 1 ? 'Hiển thị câu hỏi' : 'Ẩn câu hỏi';
                    toastr()->success("Thay đổi $label thành $statusText");
                } else {
                    toastr()->success("Thay đổi $label thành " . $validatedData[$field]);
                }
            }
        }

        $question->fill($validatedData);
        $question->updated_at = now('Asia/Ho_Chi_Minh');
        $question->save();
        return redirect()->route('questions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();
            toastr()->success("Xóa thành công Câu hỏi: $question->question");
        } catch (ModelNotFoundException $exception) {
            toastr()->error('Xóa thất bại');
        }
        return redirect()->route('questions.index');
    }

    public function quick_view_question(Request $request)
    {
        $subjects_id = $request->id_subjects;
        $question_id = $request->id_questions;
        $question = Question::findOrFail($question_id);
        $subject = Subject::findOrFail($subjects_id);

        $level = Level::findOrFail($question->level_id);

        $output = [
            'question' => $question->question,
            'option_a' => $question->option_a,
            'option_b' => $question->option_b,
            'option_c' => $question->option_c,
            'option_d' => $question->option_d,
            'answer' => $question->answer,
            'picture' => $question->picture,
            'subject' => $subject->name,
            'level' => $level->name,
        ];

        return response()->json($output);
    }

    public function importExcelData(Request $request)
    {
        $request->validate(
            [
                'file_import' => 'required|mimes:xlsx,xls,csv|file|max:2048',
                'selected_subject_id' => 'required|exists:subjects,id',
            ],
            [
                'required' => 'Vui lòng chọn file cần import',
                'mimes' => 'File phải có định dạng xlsx, xls, csv',
                'file' => 'File không hợp lệ',
                'max' => 'File không được quá 2MB',
                'exists' => 'Môn học không tồn tại',
            ]
        );

        $file = $request->file('file_import');
        Excel::import(new QuestionsImport($request->selected_subject_id), $file);

        toastr()->success('Import dữ liệu thành công');
        return redirect()->route('questions.index');
    }

    public function updateStatusQuestions(Request $request)
    {
        $question = Question::findOrFail($request->id);
        $status = $request->checked ? 1 : 0;
        $question->status = $status;
        $question->updated_at = now('Asia/Ho_Chi_Minh');
        $question->save();

        return $status;
    }
}
