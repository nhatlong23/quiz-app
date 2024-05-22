<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('can:users.viewAny');
        Route::get('create', [UserController::class, 'create'])->name('users.create')->middleware('can:users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('can:users.edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('can:users.destroy');
    });
});
