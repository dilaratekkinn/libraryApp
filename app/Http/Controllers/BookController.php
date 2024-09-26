<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class BookController extends Controller
{
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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        list($books, $count) = $this->bookService->listAll($request->all());
        try {
            return $this->successResponse->setData([
                    'books' => $books,
                    'count' => $count
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


    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request)
    {
        try {
            $this->bookService->createRecord($request->all());
            return $this->successResponse->setData([
            ])->setMessages(
                Lang::get('Successfully Added'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
