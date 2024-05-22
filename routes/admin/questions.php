<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'questions'], function () {
        Route::get('/', [QuestionsController::class, 'index'])->name('questions.index')->middleware('can:questions.viewAny');
        Route::get('create', [QuestionsController::class, 'create'])->name('questions.create')->middleware('can:questions.create');
        Route::get('show/{id}', [QuestionsController::class, 'show'])->name('questions.show')->middleware('can:questions.view');
        Route::post('store', [QuestionsController::class, 'store'])->name('questions.store');
        Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('questions.edit')->middleware('can:questions.edit');
        Route::put('update/{id}', [QuestionsController::class, 'update'])->name('questions.update');
        Route::delete('delete/{id}', [QuestionsController::class, 'destroy'])->name('questions.destroy')->middleware('can:questions.destroy');
        Route::post('questions/import', [QuestionsController::class, 'ImportExcelData'])->name('questions.import')->middleware('can:questions.import');
        Route::post('quick-view-question', [QuestionsController::class, 'quick_view_question'])->name('quick_view_question')->middleware('can:quick_view_question');
        Route::post('update-status-questions', [QuestionsController::class, 'updateStatusQuestions'])->name('updateStatusQuestions')->middleware('can:updateStatusQuestions');
    });
});
