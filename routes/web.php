<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/detail/{id?}', [HomeController::class, 'detail'])->name('detail');

Route::get('/list/{id?}', [HomeController::class, 'list'])->name("list"); //->middleware('link'); // middleware de su dung cho: Linkeys\UrlSigner\Facade\UrlSigner

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('about', [HomeController::class, "about"])->name('about');

Route::get('test', function () {
    // test url voi chu ky(neu co nguoi sua id sang=3 thi se bao loi)
    // $signutre = URL::signedRoute('detail', ['user' => 2]);
    // echo $signutre;
    // return;


    // tao url co chu ky voi thoi gian song nhat dinh(2 phut).
    // $urlOnceTime = URL::temporarySignedRoute( 'detail', now()->addMinutes(2), ['id' => 12] );
    // echo($urlOnceTime);


    // echo(action([HomeController::class, 'list'], ['id' => 1]));
    // return redirect($signutre);
    // return 123;
});

Route::get('testUrl', function (Request $request)  {
    // $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate('https://www.example.com/invitation');
    // echo $link->getFullUrl(); // https://www.example.com/invitation?uuid=UUID

    $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate(action([HomeController::class, 'list']), ['id' => 1], '+1 hours', 1);
    echo $link->getFullUrl();
});

require __DIR__ . '/auth.php';
