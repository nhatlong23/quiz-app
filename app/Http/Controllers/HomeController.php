<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Visitor;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_question = Question::count();
        $totalVisitors = Visitor::count();
        $totalExams = Exam::count();
        $totalStudents = Student::count();

        $subMinutes = Carbon::now('Asia/Ho_Chi_Minh')->subMinutes(1);
        $onlineVisitors = Visitor::where('last_activity', '>=', $subMinutes)->count();
        $visitors = Visitor::all()->sortByDesc('last_activity');

        return view('layouts.home', compact('totalVisitors', 'onlineVisitors', 'visitors', 'total_question', 'totalExams', 'totalStudents'));
    }
}
