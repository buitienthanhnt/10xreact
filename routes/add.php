<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'home']);

Route::get('{category?}.htm', [HomeController::class, 'category'])->name('cate');

Route::get('status', [\App\Http\Controllers\Frontend\ContentController::class, 'listStatus']);
