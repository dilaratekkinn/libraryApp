<?php

namespace App\Http\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class BookService
{
    public function listAll(array $parameters)
    {
        $defaults = [
            'pageNumber' => 1,
            'rowsPerPage' => 20,
        ];

        $parameters = array_merge($defaults, $parameters);
        $booksQuery = Book::query();
        $count = $booksQuery->count();
        $books = $booksQuery
            ->orderBy('id', 'desc')
            ->offset(($parameters['pageNumber'] - 1) * $parameters['rowsPerPage'])
            ->limit($parameters['rowsPerPage'])
            ->get();

        return [$books, $count];
    }

    public function createRecord(array $parameters)
    {
        $checkBook = Book::where('name',$parameters['name'])->first();
        if($checkBook){
            throw new \Exception(Lang::get('That Book Is Already Exits'));
        }
        $book = new Book();
        $book->name=$parameters['name'];
        $book->subtitle=$parameters['subtitle'];
        $book->summary=$parameters['summary'];
        $book->cover_image=$parameters['cover_image'];
        $book->author_id=$parameters['author_id'];

        foreach ($parameters['libraries'] as $library){

        }

        $book->published_year=$parameters['published_year'];
        $book->is_active=$parameters['is_active'];
        $book->save();
        foreach ($parameters['category_ids'] as $category){
            $checkCategory=Category::where('name',$category['name'])->first();

        }

    }
}
