<?php

namespace App\Http\Controllers;

use App\Http\ApiResponses\FailResponse;
use App\Http\ApiResponses\SuccessResponse;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryVersionResource;
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

    public function show($id)
    {
        try {
            return $this->successResponse->setData([
                'category' => new CategoryResource($this->categoryService->show($id))
            ])->setMessages(
                Lang::get('Category Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

    public function create(CategoryCreateRequest $request)
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

    public function update($id, CategoryUpdateRequest $request)
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

    public function delete($id)
    {
        try {
            $this->categoryService->delete($id);
            return $this->successResponse->setMessages(
                Lang::get('Category Deleted Successfully'),
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
                'category_versions' => CategoryVersionResource::collection($this->categoryService->version($id))
            ])->setMessages(
                Lang::get(' Category Versions Listed Successfully'),
            )->send();
        } catch (\Exception $e) {
            return $this->failResponse->setMessages([
                'main' => $e->getMessage(),
            ])->send();
        }
    }

}
