<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'levels'], function () {
        Route::get('/', [LevelController::class, 'index'])->name('levels.index')->middleware('can:levels.viewAny');
        Route::get('create', [LevelController::class, 'create'])->name('levels.create')->middleware('can:levels.create');
        Route::post('store', [LevelController::class, 'store'])->name('levels.store');
        Route::get('edit/{id}', [LevelController::class, 'edit'])->name('levels.edit')->middleware('can:levels.edit');
        Route::put('update/{id}', [LevelController::class, 'update'])->name('levels.update');
        Route::delete('delete/{id}', [LevelController::class, 'destroy'])->name('levels.destroy')->middleware('can:levels.destroy');
        Route::post('update-status-levels', [LevelController::class, 'updateStatusLevels'])->name('updateStatusLevels')->middleware('can:updateStatusLevels');
    });
});
