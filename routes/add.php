<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
	return Inertia::render('Dashboard');
});

Route::get('{category?}.htm', [HomeController::class, 'category'])->name('cate');

Route::get('status', [\App\Http\Controllers\Frontend\ContentController::class, 'listStatus']);

Route::get('/detail/{alias}.html', [HomeController::class, 'detail'])->name('detail');

Route::get('/list/{id?}', [HomeController::class, 'list'])->name("list"); //->middleware('link'); // middleware de su dung cho: Linkeys\UrlSigner\Facade\UrlSigner

Route::get('about', [HomeController::class, "about"])->name('about');

Route::get('account', [HomeController::class, 'account'])->name('account');

Route::get('writer/{id}', [HomeController::class, 'writerDetail'])->name('writerDetail');
