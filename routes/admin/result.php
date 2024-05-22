<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'result'], function () {
        Route::get('/', [ResultController::class, 'index'])->name('result.index')->middleware('can:result.viewAny');
        Route::get('show/{id}', [ResultController::class, 'show'])->name('result.show')->middleware('can:result.view');
    });
});
