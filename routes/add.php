<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'home']);

Route::get('{category?}.htm', [HomeController::class, 'category'])->name('cate');

Route::get('status', [\App\Http\Controllers\Frontend\ContentController::class, 'listStatus']);

Route::get('/detail/{id?}', [HomeController::class, 'detail'])->name('detail');

Route::get('/list/{id?}', [HomeController::class, 'list'])->name("list"); //->middleware('link'); // middleware de su dung cho: Linkeys\UrlSigner\Facade\UrlSigner

Route::get('about', [HomeController::class, "about"])->name('about');
