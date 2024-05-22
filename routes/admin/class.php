<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasssController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'class'], function () {
        Route::get('/', [ClasssController::class, 'index'])->name('class.index')->middleware('can:class.viewAny');
        Route::get('create', [ClasssController::class, 'create'])->name('class.create')->middleware('can:class.create');
        Route::get('show/{id}', [ClasssController::class, 'show'])->name('class.show')->middleware('can:class.view');
        Route::post('store', [ClasssController::class, 'store'])->name('class.store');
        Route::get('edit/{id}', [ClasssController::class, 'edit'])->name('class.edit')->middleware('can:class.edit');
        Route::put('update/{id}', [ClasssController::class, 'update'])->name('class.update');
        Route::delete('delete/{id}', [ClasssController::class, 'destroy'])->name('class.destroy')->middleware('can:class.destroy');
        Route::post('quick-view-class', [ClasssController::class, 'quick_view_class'])->name('quick_view_class')->middleware('can:quick_view_class');
        Route::post('update-status-class', [ClasssController::class, 'updateStatusClasss'])->name('updateStatusClasss')->middleware('can:updateStatusClasss');
    });
});
