<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

Route::group(['prefix' => 'admin'], function () {
    Route::resource('infos', InfoController::class);
});
