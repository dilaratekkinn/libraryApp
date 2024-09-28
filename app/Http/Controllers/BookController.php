<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Requests\Book\BookAddMediaRequest;
use App\Http\Requests\Book\BookCreateRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookVersionResource;
use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class BookController extends Controller
{
    private BookService $bookService;
    private SuccessResponse $successResponse;
    private FailResponse $failResponse;

    public function __construct(
        BookService     $bookService,
        SuccessResponse $successResponse,
        FailResponse    $failResponse,
    )
    {
        $this->bookService = $bookService;
        $this->successResponse = $successResponse;
        $this->failResponse = $failResponse;
    }

    public function index()
    {
        try {
            return $this->successResponse->setData([
                    'books' => BookResource::collection($this->bookService->listAll()),
                ]
            )->setMessages(
                Lang::get('Books are listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse->setData([
                'book' => new BookResource($this->bookService->show($id))
            ])->setMessages(
                Lang::get('Book Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function create(BookCreateRequest $request)
    {
        try {
            $book = $this->bookService->createData($request->all());
            return $this->successResponse->setData([
                'book' => new BookResource($book)
            ])->setMessages(
                Lang::get('Book Created Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function update($id, BookUpdateRequest $request)
    {
        try {
            $book = $this->bookService->updateData($id, $request->all());
            return $this->successResponse->setData([
                'book' => new BookResource($book)
            ])->setMessages(
                Lang::get('Book Updated Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function delete($id)
    {
        try {
            $this->bookService->delete($id);
            return $this->successResponse->setMessages(
                Lang::get('Book Deleted Successfully'),
            )->send();

        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function versions($id)
    {
        try {
            return $this->successResponse->setData([
                'book_versions' => BookVersionResource::collection($this->bookService->version($id))
            ])->setMessages(
                Lang::get('Book Versions Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function addMedia(BookAddMediaRequest $request, $id)
    {
        try {
            $book = $this->bookService->addMedia($id, $request->all());
            return $this->successResponse->setData([
                'book' => new BookResource($book)
            ])->setMessages(
                Lang::get('Book Created Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function deleteMedia($id, $mediaId)
    {
        try {
            $this->bookService->deleteMedia($id, $mediaId);
            return $this->successResponse->setMessages(
                Lang::get('Book Media Deleted Successfully'),
            )->send();

        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }
}
