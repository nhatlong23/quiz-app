<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultQuestion;
use Illuminate\Http\Request;
use App\Models\Student;

class ResultController extends Controller
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
        $result_list = Result::with('result_student')->orderBy('id', 'desc')->get()->unique('students_id');
        return view('admin.result.index', compact('result_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $results = Result::where('students_id', $student_id)
            ->with(['result_exam', 'result_student'])
            ->get();

        $resultQuestions = ResultQuestion::where('students_id', $student_id)->get();
        $student = Student::find($student_id);

        return view('admin.result.show', compact('results', 'resultQuestions', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
