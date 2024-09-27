<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private SuccessResponse $successResponse;
    private FailResponse $failResponse;

    public function __construct(
        CategoryService $categoryService,
        SuccessResponse $successResponse,
        FailResponse    $failResponse,
    )
    {
        $this->categoryService = $categoryService;
        $this->successResponse = $successResponse;
        $this->failResponse = $failResponse;
    }

    public function index()
    {
        try {
            return $this->successResponse->setData([
                    'categories' => CategoryResource::collection($this->categoryService->listAll()),
                ]
            )->setMessages(
                Lang::get('Categories are listed Successfully'),
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
                'category' => new CategoryResource($this->categoryService->show($request->id))
            ])->setMessages(
                Lang::get('Category Listed Successfully'),
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
            $category = $this->categoryService->createData($request->all());
            return $this->successResponse->setData([
                'category' => new CategoryResource($category)
            ])->setMessages(
                Lang::get('Category Created Successfully'),
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
            $category = $this->categoryService->updateData($id, $request->all());
            return $this->successResponse->setData([
                'category' => new CategoryResource($category)
            ])->setMessages(
                Lang::get('Category Updated Successfully'),
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
                $this->categoryService->delete($request->id)
            ])->setMessages(
                Lang::get('Category Deleted Successfully'),
            )->send();

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByPagination(Request $request)
    {

        try {
            list($categories, $count) = $this->categoryService->getByPagination($request->all());
            return $this->successResponse->setData([
                    'categories' => CategoryResource::collection($categories),
                    'count' => $count
                ]
            )->setMessages(
                Lang::get('Categories are listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

}
