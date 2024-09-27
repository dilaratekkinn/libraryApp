<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Resources\AuthorResource;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuthorController extends Controller
{
    private AuthorService $authorService;
    private SuccessResponse $successResponse;
    private FailResponse $failResponse;

    public function __construct(
        AuthorService $authorService,
        SuccessResponse $successResponse,
        FailResponse    $failResponse,
    )
    {
        $this->authorService = $authorService;
        $this->successResponse = $successResponse;
        $this->failResponse = $failResponse;
    }

    public function index()
    {
        try {
            return $this->successResponse->setData([
                    'authorizes' => AuthorResource::collection($this->authorService->listAll()),
                ]
            )->setMessages(
                Lang::get('Authorizes are listed Successfully'),
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
                'author' => new AuthorResource($this->authorService->show($request->id))
            ])->setMessages(
                Lang::get('Author Listed Successfully'),
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
            $author = $this->authorService->createData($request->all());
            return $this->successResponse->setData([
                'author' => new AuthorResource($author)
            ])->setMessages(
                Lang::get('Author Created Successfully'),
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
            $author = $this->authorService->updateData($id, $request->all());
            return $this->successResponse->setData([
                'author' => new AuthorResource($author)
            ])->setMessages(
                Lang::get('Author Updated Successfully'),
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
            return $this->successResponse->setData([
                $this->authorService->delete($request->id)
            ])->setMessages(
                Lang::get('Author Deleted Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();        }
    }

    public function getByPagination(Request $request)
    {

        try {
            list($authorizes, $count) = $this->authorService->getByPagination($request->all());
            return $this->successResponse->setData([
                    'authorizes' => AuthorResource::collection($authorizes),
                    'count' => $count
                ]
            )->setMessages(
                Lang::get('Authorizes are listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }
}
