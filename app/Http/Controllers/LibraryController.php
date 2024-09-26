<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Resources\LibraryResource;
use App\Http\Services\LibraryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LibraryController extends Controller
{
    public function __construct(
        LibraryService  $libraryService,
        SuccessResponse $successResponse,
        FailResponse    $failResponse,
    )
    {
        $this->libraryService = $libraryService;
        $this->successResponse = $successResponse;
        $this->failResponse = $failResponse;
    }

    public function index()
    {
        try {
            return $this->successResponse->setData([
                    'libraries' => LibraryResource::collection($this->libraryService->listAll()),
                ]
            )->setMessages(
                Lang::get('Libraries are listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function show(Request $request)
    {
        try {
            return $this->successResponse->setData([
                'library' => new LibraryResource($this->libraryService->show($request->id))
            ])->setMessages(
                Lang::get('Library Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function create(Request $request)
    {
        try {
            $library = $this->libraryService->createData($request->all());
            return $this->successResponse->setData([
                'library' => new LibraryResource($library)
            ])->setMessages(
                Lang::get('Library Created Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function update($id, Request $request)
    {
        try {
            $library = $this->libraryService->updateData($id, $request->all());
            return $this->successResponse->setData([
                'library' => new LibraryResource($library)
            ])->setMessages(
                Lang::get('Library Updated Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function delete(Request $request)
    {
        try {
            return $this->libraryService->delete($request->id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByPagination(Request $request)
    {

        try {
            list($libraries, $count) = $this->libraryService->getByPagination($request->all());
            return $this->successResponse->setData([
                    'libraries' => LibraryResource::collection($libraries),
                    'count' => $count
                ]
            )->setMessages(
                Lang::get('Libraries are listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

}
