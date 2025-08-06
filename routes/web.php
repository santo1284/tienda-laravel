<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Services\AuthService;

// Ruta pública principal
Route::get('/', [HomeController::class, 'index'])->name('tienda');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('tienda');
})->name('logout');

// Ruta protegida para dashboard - solo para administradores
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');

// Ruta de redirección después del login
Route::get('/home', function () {
    $user = auth()->user();
    $redirectRoute = AuthService::getRedirectRoute($user);
    return redirect()->route($redirectRoute);
})->middleware('auth')->name('home');

Route::view('/profile', 'welcome')->name('profile');

// Rutas de registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';