<?php

namespace App\Repositories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Model;

class BookCategoryRepository extends BaseRepository
{
    public function __construct(BookCategory $model)
    {
        parent::__construct($model);
    }

    public function deleteByBookId($bookId)
    {
        return $this->model->where('book_id', $bookId)->delete();

    }

    public function deleteByCategoryId($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->delete();

    }
}
