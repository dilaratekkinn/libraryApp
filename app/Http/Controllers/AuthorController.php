<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Requests\Author\AuthorCreateRequest;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorVersionResource;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuthorController extends Controller
{
    private AuthorService $authorService;
    private SuccessResponse $successResponse;
    private FailResponse $failResponse;

    public function __construct(
        AuthorService   $authorService,
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

    public function create(AuthorCreateRequest $request)
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

    public function update($id, AuthorUpdateRequest $request)
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

    public function delete($id)
    {
        try {
            $this->authorService->delete($id);
            return $this->successResponse->setMessages(
                Lang::get('Author Deleted Successfully'),
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
                'author_versions' => AuthorVersionResource::collection($this->authorService->version($id))
            ])->setMessages(
                Lang::get('Author Versions Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }
}
