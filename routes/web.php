<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentsController;
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
    Route::get('/property/{property}', [PropertyController::class, 'find'])->name('property.find');
    Route::get('/property/all', [PropertyController::class, 'all'])->name('property.all');
    Route::post('/property/create', [PropertyController::class, 'store'])->name('property.store');
    Route::post('/property/update', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/{property}/delete', [PropertyController::class, 'destroy'])->name('property.destroy');

    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants');
    Route::get('/tenants/{tenant}', [TenantController::class, 'find']);
    Route::post('/tenants/create', [TenantController::class, 'store'])->name('tenants.store');
    Route::post('/tenants/update', [TenantController::class, 'update'])->name('tenants.update');
    Route::delete('/tenants/{tenant}/delete', [TenantController::class, 'destroy'])->name('tenants.destroy');

    Route::get('/rents', [RentsController::class, 'index'])->name('rents');
    Route::get('/rents/create', [RentsController::class, 'create'])->name('rents.create');
    Route::post('/rents/store', [RentsController::class, 'store'])->name('rents.store');


});