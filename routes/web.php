<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::middleware(['auth','role:rental-admin|rental-manager|rental-staff'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/users/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/{user}/change_password', [ProfileController::class, 'change_password'])->name('profile.change_password');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::post('/users/reset/{user}', [UserController::class, 'reset'])->name('users.reset');

    Route::get('/owners', [OwnerController::class, 'index'])->name('owners');
    Route::get('/owners/{owner}', [OwnerController::class, 'find']);
    Route::post('/owners/create', [OwnerController::class, 'store'])->name('owners.store');
    Route::post('/owners/update', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{owner}/delete', [OwnerController::class, 'destroy'])->name('owners.destroy');

    Route::get('/property', [PropertyController::class, 'index'])->name('property');

});