<?php

use Illuminate\Support\Facades\Route;

Route::prefix('adminhtml')->middleware(['adminVerify', 'adminPermission'])->group(function () {

    Route::get('/', function () {
        return ('xin chao admin');
    });

    Route::get('/dashboard', function () {
        return view('adminhtml.home');
    })->withoutMiddleware(['adminVerify', 'adminPermission']);

});
