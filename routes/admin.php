<?php

use App\Http\Controllers\AdminHtml\DashboardController;
use App\Http\Controllers\AdminHtml\PageController;
use App\Http\Controllers\AdminHtml\WriterController;
use Database\Configs\AdminPermission;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;

Route::prefix('adminhtml')->middleware(['adminVerify', 'adminPermission'])->group(function () {

    Route::get('/', [DashboardController::class, 'home'])->withoutMiddleware(['adminPermission'])->name('dashboard')->setBindingFields([
        'route_name' => 'dashboard',
        'route_icon' => 'dashboard'
    ]);

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('/login', [DashboardController::class, 'login'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/sign-up', [DashboardController::class, 'signUp'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::post('/register-user', [DashboardController::class, 'register'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/logout', [DashboardController::class, 'logout'])->withoutMiddleware(['adminPermission'])->name('admin-logout');

    Route::post('admin-login', [DashboardController::class, 'loginPost'])->withoutMiddleware(['adminVerify', 'adminPermission'])->name('admin-login');

    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'list'])->setBindingFields([
            'route_name' => 'page manage',
            'route_icon' => 'assignment',
            'show' => true,
        ]);

        Route::any('create', [PageController::class, 'create'])->setBindingFields([
            'permission' => [AdminPermission::ACTION_CREATE]
        ]);
    });

    Route::prefix('writer')->group(function (): void {
        Route::get('/', [WriterController::class, 'index'])->setBindingFields([
            'route_name' => 'writer manage',
            'route_icon' => 'groups', // https://fonts.google.com/icons
            'show' => true,
            'permission' => AdminPermission::ACTION_LIST
        ]);

        Route::get('create', [WriterController::class, 'create']);

        Route::post('register', [WriterController::class, 'store'])->name('admin_writer_create');

        Route::get('detail/{id}', [WriterController::class, 'show']);

        Route::delete('delete/{id}', [WriterController::class, 'destroy']);

        Route::get('edit/{id}', [WriterController::class, 'edit']);

        Route::post('update/{id}', [WriterController::class, 'update']);
    });
});
