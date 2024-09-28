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
        Route::get('/', [LibraryController::class, 'index'])->name('library.index');
        Route::get('/{id}', [LibraryController::class, 'show'])->name('library.show');
        Route::post('/create', [LibraryController::class, 'create'])->name('library.create');
        Route::put('/update/{id}', [LibraryController::class, 'update'])->name('library.update');
        Route::delete('/delete/{id}', [LibraryController::class, 'delete'])->name('library.delete');
        Route::get('/version/{id}', [LibraryController::class, 'versions'])->name('library.versions');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/version/{id}', [CategoryController::class, 'versions'])->name('category.versions');
    });
    Route::group(['prefix' => 'author'], function () {
        Route::get('/', [AuthorController::class, 'index'])->name('author.index');
        Route::get('/{id}', [AuthorController::class, 'show'])->name('author.show');
        Route::post('/create', [AuthorController::class, 'create'])->name('author.create');
        Route::put('/update/{id}', [AuthorController::class, 'update'])->name('author.update');
        Route::delete('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
        Route::get('/version/{id}', [AuthorController::class, 'versions'])->name('author.versions');
    });
    Route::group(['prefix' => 'book'], function () {
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::get('/{id}', [BookController::class, 'show'])->name('book.show');
        Route::post('/create', [BookController::class, 'create'])->name('book.create');
        Route::put('/update/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
        Route::post('/add-media/{id}', [BookController::class, 'addMedia'])->name('book.addMedia');
        Route::delete('/delete-media/{id}/{media_id}', [BookController::class, 'deleteMedia'])->name('book.deleteMedia');
        Route::get('/version/{id}', [BookController::class, 'versions'])->name('book.versions');
    });
});



