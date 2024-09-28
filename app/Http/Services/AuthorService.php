<?php

namespace App\Http\Services;

use App\Models\Book;
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


    public function show($id)
    {
        return $this->authorRepository->getById($id);
    }

    public function createData(array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'bio' => $parameters['bio'],
        ];

        return $this->authorRepository->createData($data);
    }

    public function updateData($id, array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'bio' => $parameters['bio'],
        ];
        return $this->authorRepository->updateData($id, $data);
    }

    public function delete($id)
    {
        $checkBooks = Book::where('author_id', $id)->count();
        if ($checkBooks > 0) {
            throw new \Exception('Delete Author Books First');
        } else {
            $this->authorRepository->deleteById($id);
        }
        return true;
    }

    public function version($id)
    {
        return $this->authorRepository->getVersions($id);
    }
}
