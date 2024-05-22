<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('can:roles.viewAny');
        Route::get('create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:roles.create');
        Route::post('store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:roles.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('can:roles.destroy');
    });
});
