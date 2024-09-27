<?php

namespace App\Providers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\ResponseInterface;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LibraryController;
use App\Http\Services\AuthorService;
use App\Http\Services\BookService;
use App\Http\Services\CategoryService;
use App\Http\Services\LibraryService;
use App\Interfaces\BaseInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\BaseRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LibraryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Services
        $this->app->when(AuthorService::class)->give(AuthorService::class);
        $this->app->when(LibraryService::class)->give(LibraryService::class);
        $this->app->when(BookService::class)->give(BookService::class);
        $this->app->when(CategoryService::class)->give(CategoryService::class);

        //Controllers
        $this->app->when(AuthorController::class)->give(AuthorService::class);
        $this->app->when(AuthorController::class)->needs(BaseInterface::class)->give(AuthorRepository::class);
        $this->app->when(AuthorController::class)->needs(ResponseInterface::class)->give(FailResponse::class);
        $this->app->when(AuthorController::class)->needs(ResponseInterface::class)->give(SuccessResponse::class);

        $this->app->when(LibraryController::class)->give(LibraryService::class);
        $this->app->when(LibraryController::class)->needs(BaseInterface::class)->give(LibraryRepository::class);
        $this->app->when(LibraryController::class)->needs(ResponseInterface::class)->give(FailResponse::class);
        $this->app->when(LibraryController::class)->needs(ResponseInterface::class)->give(SuccessResponse::class);

        $this->app->when(BookController::class)->give(BookService::class);
        $this->app->when(BookController::class)->needs(BaseInterface::class)->give(BookRepository::class);
        $this->app->when(BookController::class)->needs(ResponseInterface::class)->give(FailResponse::class);
        $this->app->when(BookController::class)->needs(ResponseInterface::class)->give(SuccessResponse::class);

        $this->app->when(CategoryController::class)->give(CategoryService::class);
        $this->app->when(CategoryController::class)->needs(BaseInterface::class)->give(CategoryRepository::class);
        $this->app->when(CategoryController::class)->needs(ResponseInterface::class)->give(FailResponse::class);
        $this->app->when(CategoryController::class)->needs(ResponseInterface::class)->give(SuccessResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
