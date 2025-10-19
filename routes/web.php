<?php

use App\Events\ViewCount;
// use App\Enums\PageEnum;
// use App\Enums\ShareEnum;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Api\PageApi;
use App\Models\Page;
use App\Providers\LanguageProvider;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr', 'vi'])) {
        abort(400);
    }
    return LanguageProvider::applyLanguage($locale);
});

Route::get('reset-language', function () {
    LanguageProvider::resetLanguage();
    return redirect()->back();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
