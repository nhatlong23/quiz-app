<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'exams'], function () {
        Route::get('/', [ExamController::class, 'index'])->name('exams.index')->middleware('can:exams.viewAny');
        Route::get('create', [ExamController::class, 'create'])->name('exams.create')->middleware('can:exams.create');
        Route::post('store', [ExamController::class, 'store'])->name('exams.store');
        Route::get('edit/{id}', [ExamController::class, 'edit'])->name('exams.edit')->middleware('can:exams.edit');
        Route::put('update/{id}', [ExamController::class, 'update'])->name('exams.update');
        Route::delete('delete/{id}', [ExamController::class, 'destroy'])->name('exams.destroy')->middleware('can:exams.destroy');
        Route::post('quick-view-exam', [ExamController::class, 'quick_view_exam'])->name('quick_view_exam')->middleware('can:quick_view_exam');
        Route::post('handle-request', [ExamController::class, 'ExamRequest'])->name('exams_request')->middleware('can:exams_request');
        Route::post('add-exam-class', [ExamController::class, 'addExamToClass'])->name('addExamToClass')->middleware('can:addExamToClass');
        Route::post('update-status-exams', [ExamController::class, 'updateStatusExams'])->name('updateStatusExams')->middleware('can:updateStatusExams');
        Route::post('delete-question-exam', [ExamController::class, 'deleteQuestionFromExam'])->name('deleteQuestionFromExam')->middleware('can:deleteQuestionFromExam');
    });
});
