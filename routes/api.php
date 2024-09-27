<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'library'], function () {
        Route::get('/', [LibraryController::class, 'index']);
        Route::get('/{id}', [LibraryController::class, 'show'])->name('library.show');
        Route::get('/version/{id}', [LibraryController::class, 'versions']);
        Route::post('/create', [LibraryController::class, 'create']);
        Route::post('/update/{id}', [LibraryController::class, 'update']);
        Route::post('/delete', [LibraryController::class, 'delete']);
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/version/{id}', [CategoryController::class, 'versions']);
        Route::post('/create', [CategoryController::class, 'create']);
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::post('/delete', [CategoryController::class, 'delete']);
    });
    Route::group(['prefix' => 'author'], function () {
        Route::get('/', [AuthorController::class, 'index']);
        Route::get('/{id}', [AuthorController::class, 'show'])->name('author.show');
        Route::get('/version/{id}', [AuthorController::class, 'versions']);
        Route::post('/create', [AuthorController::class, 'create']);
        Route::post('/update/{id}', [AuthorController::class, 'update']);
        Route::post('/delete', [AuthorController::class, 'delete']);
    });
    Route::group(['prefix' => 'book'], function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{id}', [BookController::class, 'show'])->name('book.show');
        Route::get('/version/{id}', [BookController::class, 'versions']);
        Route::post('/create', [BookController::class, 'create']);
        Route::post('/update/{id}', [BookController::class, 'update']);
        Route::post('/delete', [BookController::class, 'delete']);
    });
});



