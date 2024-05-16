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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InfoController;
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
Route::get('/load-more-blogs', [IndexController::class, 'loadMoreBlogs'])->name('loadMoreBlogs');
Route::get('/blog-detail/{slug}', [IndexController::class, 'blog_detail'])->name('blog_detail');
Route::get('/knowledge', [IndexController::class, 'knowledge'])->name('knowledge');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::post('/send-contact-email', [IndexController::class, 'sendContactEmail'])->name('send.contact.email');

Route::middleware(['auth.student', 'check.class.access'])->group(function () {
    Route::get('/exam/{class_id}', [IndexController::class, 'redirectToExam'])->name('redirectToExam');
});

Route::middleware(['auth.student', 'check_exam_availability', 'check_exam_submission', 'check_exam_expiration', 'check_exam_password'])->group(function () {
    Route::get('/test-exam/{exam_id}', [IndexController::class, 'testExam'])->name('testExam');
});

Route::post('/submit-answers', [IndexController::class, 'submitAnswers'])->name('submitAnswers');

Route::middleware(['auth.student'])->group(function () {
    Route::get('/login-quiz', [LoginStudentsController::class, 'redirectToLogin'])->name('redirectToLogin');
    Route::get('/logoutStudents', [LoginStudentsController::class, 'logoutStudents'])->name('logoutStudents');
    Route::post('/check-password-exam', [IndexController::class, 'checkPasswordExam'])->name('checkPasswordExam');
    Route::get('/profile', [IndexController::class, 'profile'])->name('profile');
    Route::get('/history-exam', [IndexController::class, 'history_exam'])->name('history_exam');
    Route::post('/save-profile', [IndexController::class, 'save_profile'])->name('save_profile');
    Route::get('/detail-exam-history/{id}', [IndexController::class, 'detailExamHistory'])->name('detailExamHistory');
});

Route::post('/checkLoginStudents', [LoginStudentsController::class, 'checkLoginStudents'])->name('checkLoginStudents');

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
Route::resource('blogs', BlogController::class);
Route::resource('infos', InfoController::class);

Route::post('quick-view-question', [QuestionsController::class, 'quick_view_question'])->name('quick_view_question');
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
Route::post('update-status-blogs', [BlogController::class, 'updateStatusBlogs'])->name('updateStatusBlogs');
Route::post('delete-question-exam', [ExamController::class, 'deleteQuestionFromExam'])->name('deleteQuestionFromExam');
