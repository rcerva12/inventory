<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () { 
//     return view('pages/auth.login'); 
// });
Route::post('login',[LoginController::class,'user_login']);
Route::get('/dashboard', function () { 
    return view('pages/dashboard'); 
});
Route::get('/', function () { 
    view('pages/auth.login'); 
    if (session()->has('username'))
    {
        return redirect('/dashboard'); 
    }
    return view('pages/auth.login'); 
});
Route::get('/logout', function () { 
    if (session()->has('username'))
    {
        session()->pull('username');
    }
    return redirect('/'); 
});
Route::get('/register', function () { 
    return view('pages/auth.register'); 
});
Route::post('create_user', [LoginController::class,'create_user'])->name('create_user');




// Route::resource('/login', 'LoginController')->only(['index', 'store']);
// Route::middleware(['loggedin'])->group(function() {
//     Route::resource('/dashboard', 'DashboardController')->only('index');
//     Route::middleware(['roleaccess'])->group(function() {
        
//     });
// });
