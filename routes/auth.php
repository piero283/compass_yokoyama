<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //ユーザー登録画面 registerViewから変更
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    //ユーザー登録処理
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->name('registerPost');
    //ログイン画面 loginViewから変更
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
        //ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('loginPost');
});
