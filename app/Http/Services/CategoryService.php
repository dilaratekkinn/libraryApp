<?php

namespace App\Http\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getByPagination(array $parameters)
    {
        return $this->categoryRepository->getAllByPagination($parameters);
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

    public function updateData($id,array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
        ];
       return  $this->categoryRepository->updateData($id,$data);
    }

    public function delete($id){

    return $this->categoryRepository->deleteById($id);
    }
}
