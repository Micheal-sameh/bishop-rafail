<?php

use App\Http\Controllers\Api\V1\DocumentController;
use App\Http\Controllers\Api\V1\SermonController;
use App\Http\Controllers\Api\V1\SermonPlaylistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/documetation', function () {
    // Define which documentation to use, defaulting to 'default' if not set
    $documentation = config('l5-swagger.documentation') ?? 'default';
    $useAbsolutePath = true;

    return view('vendor.l5-swagger.index', compact('documentation', 'useAbsolutePath'));
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (): void {
    Route::get('/sermons-playlists', [SermonPlaylistController::class, 'index']);
    Route::get('/sermons', [SermonController::class, 'index']);
    Route::get('/books', [DocumentController::class, 'index']);
});
