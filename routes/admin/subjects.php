<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectsController;


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/', [SubjectsController::class, 'index'])->name('subjects.index')->middleware('can:subjects.viewAny');
        Route::get('create', [SubjectsController::class, 'create'])->name('subjects.create')->middleware('can:subjects.create');
        Route::post('store', [SubjectsController::class, 'store'])->name('subjects.store');
        Route::get('edit/{id}', [SubjectsController::class, 'edit'])->name('subjects.edit')->middleware('can:subjects.edit');
        Route::put('update/{id}', [SubjectsController::class, 'update'])->name('subjects.update');
        Route::delete('delete/{id}', [SubjectsController::class, 'destroy'])->name('subjects.destroy')->middleware('can:subjects.destroy');
        Route::post('update-status-subjects', [SubjectsController::class, 'updateStatusSubjects'])->name('updateStatusSubjects')->middleware('can:updateStatusSubjects');
    });
});
