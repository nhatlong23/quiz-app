<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('can:permissions.viewAny');
        Route::get('create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('can:permissions.create');
        Route::post('store', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('can:permissions.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('can:permissions.destroy');
    });
});
