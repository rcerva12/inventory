<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;





Route::middleware(['alreadyloggedin'])->group(function () {
    Route::get('/', function () { 
        return view('pages/auth.login'); 
    });
    Route::post('login',[LoginController::class,'user_login'])->name('login');
});


Route::middleware(['isloggedin'])->group(function() {
    Route::get('dashboard',[LoginController::class,'dashboard']);
    Route::resource('users', '\App\Http\Controllers\UserController');
    Route::post('users/delete', [UserController::class, 'deleteUser'])->name('users_delete');
    // Route::post('user/add', [UserController::class, 'store'])->name('users_add');
});
Route::get('logout',[LoginController::class,'logout']);


Route::get('/register', function () { 
    return view('pages/auth.register'); 
});
Route::post('create_user', [LoginController::class,'create_user'])->name('create_user');

// TEST
// Route::get('ajax-request', [TestController::class, 'create']);
// Route::post('ajax-request', [TestController::class, 'store']);

Route::get('test', [App\Http\Controllers\TestController::class, 'index']);
Route::post('todos/create', [App\Http\Controllers\TestController::class, 'store']);
Route::put('todos/{todo}', [App\Http\Controllers\TestController::class, 'update']);
Route::delete('todos/{todo}', [App\Http\Controllers\TestController::class, 'destroy']);