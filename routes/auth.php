<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //ユーザー登録画面
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('registerView');
    //ユーザー登録処理
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->name('registerPost');
    //ログイン画面
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('loginView');
        //ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('loginPost');
});
