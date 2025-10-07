<?php

use App\Events\ViewCount;
use App\Enums\PageEnum;
use App\Enums\ShareEnum;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Api\PageApi;
use App\Models\Page;
use App\Providers\LanguageProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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
    dd(LanguageProvider::resetLanguage());
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('test')->group(function (): void {
    Route::get('translate', function () {
        // App::setLocale('vi');
        dd(__('auth.user.name'));
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

    /**
     * test redis cache.
     */
    Route::get('redis', function () {
        Redis::set('test', 'true');
        $data = Redis::get('test');
        dd($data);
    });

    /**
     * test page detail.
     */
    Route::get('page-detail/{id}', function (int $id) {
        return (Page::find($id)->toArray());
    });

    Route::get('event', function () {
        /**
         * dispatch page view count action
         */
        ViewCount::dispatch(Page::find(40));
        /**
         * call add page info type.
         */
        PageApi::pageInfoActionRedis(40, 'heart', 'dic');
        return true;
    });

    Route::get('enum', function () {
        dd(ShareEnum::processOrder(ShareEnum::Approved));
        dd(PageEnum::Fire->value);
    });

    Route::get('knock', function () {
        return view('adminhtml.test.knock');
    });

    Route::get('testUrl', function (Request $request) {
        // $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate('https://www.example.com/invitation');
        // echo $link->getFullUrl(); // https://www.example.com/invitation?uuid=UUID

        $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate(action([HomeController::class, 'list']), ['id' => 1], '+1 hours', 1);
        echo $link->getFullUrl();
    });

    Route::get('json', function () {
        // abort(500, 'error by demo');
        return response()->json([
            'a' => 123,
            'b' => 'pppp',
        ], 500);

        return [
            'name' => 'demo for test json',
            'value' => 123,
        ];
    });
});


require __DIR__ . '/auth.php';
