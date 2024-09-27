<?php

namespace App\Repositories;

use App\Models\BookLibrary;
use Illuminate\Database\Eloquent\Model;

class BookLibraryRepository extends BaseRepository
{
    public function __construct(BookLibrary $model)
    {
        parent::__construct($model);
    }

    public function deleteByBookId($bookId)
    {
        return $this->model->where('book_id', $bookId)->delete();

    }
    public function deleteByLibraryId($libraryId)
    {
        return $this->model->where('library_id', $libraryId)->delete();

    }
}
