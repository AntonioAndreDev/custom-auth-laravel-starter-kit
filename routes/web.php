<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Rotas para usuários não autenticados
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeUser'])->name('storeUser');

    Route::get('/new_user_confirmation/{token}', [AuthController::class, 'newUserConfirmation'])->name('newUserConfirmation');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot_password', [AuthController::class, 'sendForgotPasswordLink'])->name('sendForgotPasswordLink');
    Route::get('/reset_password/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset_password', [AuthController::class, 'resetPasswordUpdate'])->name('resetPasswordUpdate');


});


// Rota para usuários autenticados
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('auth.profile');
    })->name('profile');

    Route::post('/profile/change_password', [UserController::class, 'changePassword'])->name('profile.change_password');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post("/delete_account", [UserController::class, 'deleteAccount'])->name('deleteAccount');

});
