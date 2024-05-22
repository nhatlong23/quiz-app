<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentsController::class, 'index'])->name('students.index')->middleware('can:students.viewAny');
        Route::get('create', [StudentsController::class, 'create'])->name('students.create')->middleware('can:students.create');
        Route::post('store', [StudentsController::class, 'store'])->name('students.store');
        Route::get('edit/{id}', [StudentsController::class, 'edit'])->name('students.edit')->middleware('can:students.edit');
        Route::put('update/{id}', [StudentsController::class, 'update'])->name('students.update');
        Route::delete('delete/{id}', [StudentsController::class, 'destroy'])->name('students.destroy')->middleware('can:students.destroy');
        Route::post('quick-view-students', [StudentsController::class, 'quick_view_students'])->name('quick_view_students')->middleware('can:quick_view_students');
        Route::post('update-status-students', [StudentsController::class, 'updateStatusStudents'])->name('updateStatusStudents')->middleware('can:updateStatusStudents');
    });
});
