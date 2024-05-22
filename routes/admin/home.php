<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::match(['get', 'post'], 'register', function () {
        return redirect('/');
    });

    Route::get('home', [HomeController::class, 'index'])->name('home');
});
