<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginStudentsController;
use App\Http\Controllers\TelegramController;
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

Route::get('/', [IndexController::class, 'homepage'])->name('homepage');
Route::get('/load-more-blogs', [IndexController::class, 'loadMoreBlogs'])->name('loadMoreBlogs');
Route::get('tags/{tag}', [IndexController::class, 'tags'])->name('tags');
Route::get('/blog-detail/{slug}', [IndexController::class, 'blog_detail'])->name('blog_detail');
Route::get('/knowledge', [IndexController::class, 'knowledge'])->name('knowledge');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/terms-of-service', [IndexController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [IndexController::class, 'privacy'])->name('privacy');
Route::post('/send-contact-email', [IndexController::class, 'sendContactEmail'])->name('send.contact.email');
Route::post('/send-email-telegram', [TelegramController::class, 'sendEmailTelegram'])->name('send.email.telegram');

Route::post('/load-comment', [IndexController::class, 'load_comment'])->name('load_comment');
Route::post('/send-comment', [IndexController::class, 'send_comment'])->name('send_comment');
Route::post('/like-comment', [IndexController::class, 'like_comment'])->name('like_comment');

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

Route::get('/updated-activity', [TelegramController::class, 'updatedActivity'])->name('updatedActivity');

Route::get('/riot.txt', [IndexController::class, 'riot'])->name('riot');