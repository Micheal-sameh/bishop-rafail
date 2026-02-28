<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\SermonPlaylistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('users.index');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('users')->name('users.')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/{user}/delete', [UserController::class, 'delete'])->name('delete');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    });

    Route::prefix('sermons-playlists')->name('sermons-playlists.')->group(function (): void {
        Route::get('/', [SermonPlaylistController::class, 'index'])->name('index');
        Route::get('/create', [SermonPlaylistController::class, 'create'])->name('create');
        Route::post('/', [SermonPlaylistController::class, 'store'])->name('store');
        Route::get('/{sermons_playlist}', [SermonPlaylistController::class, 'show'])->name('show');
        Route::get('/{sermons_playlist}/edit', [SermonPlaylistController::class, 'edit'])->name('edit');
        Route::put('/{sermons_playlist}', [SermonPlaylistController::class, 'update'])->name('update');
        Route::get('/{sermons_playlist}/delete', [SermonPlaylistController::class, 'delete'])->name('delete');
        Route::delete('/{sermons_playlist}', [SermonPlaylistController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('sermons')->name('sermons.')->group(function (): void {
        Route::get('/', [SermonController::class, 'index'])->name('index');
        Route::get('/create', [SermonController::class, 'create'])->name('create');
        Route::post('/', [SermonController::class, 'store'])->name('store');
        Route::get('/{sermon}', [SermonController::class, 'show'])->name('show');
        Route::get('/{sermon}/edit', [SermonController::class, 'edit'])->name('edit');
        Route::put('/{sermon}', [SermonController::class, 'update'])->name('update');
        Route::get('/{sermon}/delete', [SermonController::class, 'delete'])->name('delete');
        Route::delete('/{sermon}', [SermonController::class, 'destroy'])->name('destroy');
    });
});
