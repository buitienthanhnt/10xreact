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

    Route::get('/login', [DashboardController::class, 'login'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/sign-up', [DashboardController::class, 'signUp'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::post('/register-user', [DashboardController::class, 'register'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/logout', [DashboardController::class, 'logout'])->withoutMiddleware(['adminPermission'])->name('admin-logout');

    Route::post('admin-login', [DashboardController::class, 'loginPost'])->withoutMiddleware(['adminVerify', 'adminPermission'])->name('admin-login');

    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'list'])->setBindingFields([
            'route_name' => 'page list',
            'route_icon' => 'assignment',
            'show' => true,
        ]);

        Route::any('create', [PageController::class, 'create'])->setBindingFields([
            'route_name' => 'new page',
            'route_icon' => 'cloud',
            'show' => true,
            'permission' => [AdminPermission::ACTION_CREATE]
        ]);
    });

    Route::prefix('writer')->group(function () : void {
        Route::get('/', [WriterController::class, 'index'])->setBindingFields([
            'route_name' => 'list writer',
            'route_icon' => 'computer',
            'show' => true,
        ]);

        Route::get('create', [WriterController::class, 'create']);

        Route::post('register', [WriterController::class, 'store'])->name('admin_writer_create');

    });
});
