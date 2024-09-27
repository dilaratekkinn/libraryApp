<?php

namespace App\Http\Services;


use App\Repositories\BookCategoryRepository;
use App\Repositories\BookLibraryRepository;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Lang;

class BookService
{
    private BookRepository $bookRepository;
    private BookCategoryRepository $bookCategoryRepository;
    private BookLibraryRepository $bookLibraryRepository;

    public function __construct(
        BookRepository         $bookRepository,
        BookCategoryRepository $bookCategoryRepository,
        BookLibraryRepository  $bookLibraryRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->bookCategoryRepository = $bookCategoryRepository;
        $this->bookLibraryRepository = $bookLibraryRepository;
    }

    public function listAll()
    {
        return $this->bookRepository->getAll();
    }

    public function getByPagination(array $parameters)
    {
        return $this->bookRepository->getAllByPagination($parameters);
    }

    public function show($id)
    {
        return $this->bookRepository->getById($id);
    }

    public function createData(array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'subtitle' => $parameters['subtitle'],
            'author_id' => $parameters['author_id'],
            'summary' => $parameters['summary'],
            'published_year' => $parameters['published_year'],
        ];

        $book = $this->bookRepository->createData($data);
        foreach ($parameters['category_ids'] as $categoryId) {
            $data = [
                'book_id' => $book->id,
                'category_id' => $categoryId
            ];
            $this->bookCategoryRepository->createData($data);
        }

        foreach ($parameters['library_ids'] as $libraryId) {
            $data = [
                'book_id' => $book->id,
                'library_id' => $libraryId
            ];
            $this->bookLibraryRepository->createData($data);
        }
        return $book;
    }

    public function updateData($id, array $parameters)
    {
        $data = [
            'name' => $parameters['name'],
            'subtitle' => $parameters['subtitle'],
            'author_id' => $parameters['author_id'],
            'summary' => $parameters['summary'],
            'published_year' => $parameters['published_year'],
        ];
        return $this->bookRepository->updateData($id, $data);
    }

    public function delete($id)
    {

        return $this->bookRepository->deleteById($id);
    }
}
