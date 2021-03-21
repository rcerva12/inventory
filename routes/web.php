<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;





Route::middleware(['alreadyloggedin'])->group(function () {
    Route::get('/', function () { 
        return view('pages/auth.login'); 
    });
    Route::post('login',[LoginController::class,'user_login'])->name('login');
});


Route::middleware(['isloggedin'])->group(function() {
    Route::get('dashboard',[LoginController::class,'dashboard']);
});
Route::get('logout',[LoginController::class,'logout']);


Route::get('/register', function () { 
    return view('pages/auth.register'); 
});
Route::post('create_user', [LoginController::class,'create_user'])->name('create_user');


