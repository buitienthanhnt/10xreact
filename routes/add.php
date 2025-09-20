<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('{category}.htm', [HomeController::class, 'category'])->name('category');

Route::get('status', [\App\Http\Controllers\Frontend\ContentController::class, 'listStatus']);

Route::get('{alias}.html', [HomeController::class, 'detail'])->name('detail');

Route::get('tag/{value}', [HomeController::class, 'tag'])->name('tag');

Route::get('/list/{id?}', [HomeController::class, 'list'])->name("list"); //->middleware('link'); // middleware de su dung cho: Linkeys\UrlSigner\Facade\UrlSigner

Route::get('about', [HomeController::class, "about"])->name('about');

Route::get('account', [HomeController::class, 'account'])->name('account');

Route::get('docs', [HomeController::class, 'docs'])->name('docs');

Route::get('writer/{id}', [HomeController::class, 'writerDetail'])->name('writerDetail');

Route::prefix('comment')->group(function () : void {

	Route::post('add', [CommentController::class, 'store']);

});
