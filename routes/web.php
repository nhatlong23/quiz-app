<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginStudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//route homepage
Route::get('/', [IndexController::class, 'homepage'])->name('homepage');

Route::middleware(['auth.student'])->group(function () {
    Route::get('/login-quiz', [LoginStudentsController::class, 'redirectToLogin'])->name('redirectToLogin');
    Route::post('/checkLoginStudents', [LoginStudentsController::class, 'checkLoginStudents'])->name('checkLoginStudents');
});
Route::get('/logoutStudents', [LoginStudentsController::class, 'logoutStudents'])->name('logoutStudents');


Auth::routes();
// Route::match(['get', 'post'], 'register', function(){
//     return redirect('/');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

//route admim
Route::resource('subjects', SubjectsController::class);
Route::resource('students', StudentsController::class);
Route::resource('class', ClasssController::class);
Route::resource('questions', QuestionsController::class);
Route::resource('blocks', BlockController::class);
Route::resource('levels', LevelController::class);
Route::resource('exams', ExamController::class);

Route::post('quick-view', [QuestionsController::class, 'quick_view'])->name('quick_view');
Route::post('quick-view-class', [ClasssController::class, 'quick_view_class'])->name('quick_view_class');
Route::post('quick-view-students', [StudentsController::class, 'quick_view_students'])->name('quick_view_students');
Route::post('quick-view-exam', [ExamController::class, 'quick_view_exam'])->name('quick_view_exam');
Route::post('questions/import', [QuestionsController::class, 'ImportExcelData'])->name('questions.import');
Route::post('/exam/handle-request', [ExamController::class, 'ExamRequest'])->name('exams_request');
Route::post('add-exam-class', [ExamController::class, 'addExamToClass'])->name('addExamToClass');
Route::post('update-status-subjects', [SubjectsController::class, 'updateStatusSubjects'])->name('updateStatusSubjects');
Route::post('update-status-levels', [LevelController::class, 'updateStatusLevels'])->name('updateStatusLevels');
Route::post('update-status-questions', [QuestionsController::class, 'updateStatusQuestions'])->name('updateStatusQuestions');
Route::post('update-status-exams', [ExamController::class, 'updateStatusExams'])->name('updateStatusExams');
Route::post('update-status-students', [StudentsController::class, 'updateStatusStudents'])->name('updateStatusStudents');
Route::post('update-status-class', [ClasssController::class, 'updateStatusClasss'])->name('updateStatusClasss');
Route::post('update-status-blocks', [BlockController::class, 'updateStatusBlocks'])->name('updateStatusBlocks');