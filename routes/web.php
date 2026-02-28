<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
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
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
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

        Route::get('/historical', [SermonController::class, 'indexHistorical'])->name('historical.index');
        Route::get('/historical/create', [SermonController::class, 'createHistorical'])->name('historical.create');
        Route::post('/historical', [SermonController::class, 'storeHistorical'])->name('historical.store');

        Route::get('/trips', [SermonController::class, 'indexTrips'])->name('trips.index');
        Route::get('/trips/create', [SermonController::class, 'createTrips'])->name('trips.create');
        Route::post('/trips', [SermonController::class, 'storeTrips'])->name('trips.store');

        Route::get('/{sermon}', [SermonController::class, 'show'])->name('show');
        Route::get('/{sermon}/edit', [SermonController::class, 'edit'])->name('edit');
        Route::put('/{sermon}', [SermonController::class, 'update'])->name('update');
        Route::get('/{sermon}/delete', [SermonController::class, 'delete'])->name('delete');
        Route::delete('/{sermon}', [SermonController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('documents')->name('documents.')->group(function (): void {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::get('/create', [DocumentController::class, 'create'])->name('create');
        Route::post('/', [DocumentController::class, 'store'])->name('store');

        Route::get('/historical', [DocumentController::class, 'indexHistorical'])->name('historical.index');
        Route::get('/historical/create', [DocumentController::class, 'createHistorical'])->name('historical.create');
        Route::post('/historical', [DocumentController::class, 'storeHistorical'])->name('historical.store');

        Route::get('/produced', [DocumentController::class, 'indexProduced'])->name('produced.index');
        Route::get('/produced/create', [DocumentController::class, 'createProduced'])->name('produced.create');
        Route::post('/produced', [DocumentController::class, 'storeProduced'])->name('produced.store');

        Route::get('/artical', [DocumentController::class, 'indexArtical'])->name('artical.index');
        Route::get('/artical/create', [DocumentController::class, 'createArtical'])->name('artical.create');
        Route::post('/artical', [DocumentController::class, 'storeArtical'])->name('artical.store');

        Route::get('/{document}', [DocumentController::class, 'show'])->name('show');
        Route::get('/{document}/edit', [DocumentController::class, 'edit'])->name('edit');
        Route::put('/{document}', [DocumentController::class, 'update'])->name('update');
        Route::get('/{document}/delete', [DocumentController::class, 'delete'])->name('delete');
        Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('destroy');
    });
});
