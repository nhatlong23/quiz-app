<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('blogs.index')->middleware('can:blogs.viewAny');
        Route::get('create', [BlogController::class, 'create'])->name('blogs.create')->middleware('can:blogs.create');
        Route::get('show/{id}', [BlogController::class, 'show'])->name('blogs.show')->middleware('can:blogs.view');
        Route::post('store', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('can:blogs.edit,id');
        Route::put('update/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('delete/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy')->middleware('can:blogs.destroy');
        Route::post('update-status-blogs', [BlogController::class, 'updateStatusBlogs'])->name('updateStatusBlogs')->middleware('can:updateStatusBlogs');
        Route::post('update-status-comment', [BlogController::class, 'updateStatusComments'])->name('updateStatusComments')->middleware('can:updateStatusComments');
        Route::get('review-comment', [BlogController::class, 'review_comment'])->name('review_comment')->middleware('can:review_comment');
        Route::post('reply-comment', [BlogController::class, 'reply_comment'])->name('reply_comment')->middleware('can:reply_comment');
    });
});
