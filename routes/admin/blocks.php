<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'blocks'], function () {
        Route::get('/', [BlockController::class, 'index'])->name('blocks.index')->middleware('can:blocks.viewAny');
        Route::get('create', [BlockController::class, 'create'])->name('blocks.create')->middleware('can:blocks.create');
        Route::post('store', [BlockController::class, 'store'])->name('blocks.store');
        Route::get('edit/{id}', [BlockController::class, 'edit'])->name('blocks.edit')->middleware('can:blocks.edit');
        Route::put('update/{id}', [BlockController::class, 'update'])->name('blocks.update');
        Route::delete('delete/{id}', [BlockController::class, 'destroy'])->name('blocks.destroy')->middleware('can:blocks.destroy');
        Route::post('update-status-blocks', [BlockController::class, 'updateStatusBlocks'])->name('updateStatusBlocks')->middleware('can:updateStatusBlocks');
    });
});
