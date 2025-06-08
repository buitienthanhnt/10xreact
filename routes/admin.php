<?php

use App\Http\Controllers\Adminhtml\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('adminhtml')->middleware(['adminVerify', 'adminPermission'])->group(function () {

    Route::get('/', [DashboardController::class, 'home'])->withoutMiddleware(['adminPermission'])->name('dashboard');

    Route::get('/login', [DashboardController::class, 'login'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/sign-up', [DashboardController::class, 'signUp'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::post('/register-user', [DashboardController::class, 'register'])->withoutMiddleware(['adminVerify', 'adminPermission']);

    Route::get('/logout', [DashboardController::class, 'logout'])->withoutMiddleware(['adminPermission'])->name('admin-logout');

    Route::post('admin-login', [DashboardController::class, 'loginPost'])->withoutMiddleware(['adminVerify', 'adminPermission'])->name('admin-login');
});
