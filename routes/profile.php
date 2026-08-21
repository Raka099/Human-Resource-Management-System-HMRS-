<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

});