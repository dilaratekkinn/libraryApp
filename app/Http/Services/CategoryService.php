<?php

namespace App\Http\Services;

use App\Repositories\BookCategoryRepository;
use App\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;
    private BookCategoryRepository $bookCategoryRepository;

    public function __construct(
        CategoryRepository     $categoryRepository,
        BookCategoryRepository $bookCategoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->bookCategoryRepository = $bookCategoryRepository;
    }

    public function listAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function show($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function createData(array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
        ];

        return $this->categoryRepository->createData($data);
    }

    public function updateData($id, array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
        ];
        return $this->categoryRepository->updateData($id, $data);
    }

    public function delete($id)
    {
        $this->bookCategoryRepository->deleteByCategoryId($id);
        $this->categoryRepository->deleteById($id);
        return true;
    }

    public function version($id)
    {
        return $this->categoryRepository->getVersions($id);
    }
}
