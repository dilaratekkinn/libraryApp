<?php

namespace App\Http\Services;

use App\Repositories\BookLibraryRepository;
use App\Repositories\LibraryRepository;

class LibraryService
{
    private LibraryRepository $libraryRepository;
    private BookLibraryRepository $bookLibraryRepository;

    public function __construct(
        LibraryRepository     $libraryRepository,
        BookLibraryRepository $bookLibraryRepository
    )
    {
        $this->libraryRepository = $libraryRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
    }

    public function listAll()
    {
        return $this->libraryRepository->getAll();
    }

    public function getByPagination(array $parameters)
    {
        return $this->libraryRepository->getAllByPagination($parameters);
    }

    public function show($id)
    {
        return $this->libraryRepository->getById($id);
    }

    public function createData(array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'address' => $parameters['address'],
        ];

        return $this->libraryRepository->createData($data);
    }

    public function updateData($id, array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'address' => $parameters['address'],
        ];
        return $this->libraryRepository->updateData($id, $data);
    }

    public function delete($id)
    {
        $this->bookLibraryRepository->deleteByLibraryId($id);
        return $this->libraryRepository->deleteById($id);
    }
}
