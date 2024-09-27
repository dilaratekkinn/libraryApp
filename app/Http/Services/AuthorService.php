<?php

namespace App\Http\Services;

use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;

class AuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(
        AuthorRepository $authorRepository
    )
    {
        $this->authorRepository = $authorRepository;
    }

    public function listAll()
    {
        return $this->authorRepository->getAll();
    }

    public function getByPagination(array $parameters)
    {
        return $this->authorRepository->getAllByPagination($parameters);
    }

    public function show($id)
    {
        return $this->authorRepository->getById($id);
    }

    public function createData(array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'bio'=>$parameters['bio'],
        ];

        return $this->authorRepository->createData($data);
    }

    public function updateData($id,array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'bio'=>$parameters['bio'],
        ];
       return  $this->authorRepository->updateData($id,$data);
    }

    public function delete($id){

    return $this->authorRepository->deleteById($id);
    }
}
