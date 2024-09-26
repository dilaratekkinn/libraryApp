<?php

use App\Http\Controllers\LibraryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'library'], function () {
    Route::get('/', [LibraryController::class, 'index']);
    Route::get('/{id}', [LibraryController::class, 'show'])->name('library.show');
    Route::post('/create', [LibraryController::class, 'create']);
    Route::post('/update/{id}', [LibraryController::class, 'update']);
    Route::post('/delete', [LibraryController::class, 'delete']);
});


