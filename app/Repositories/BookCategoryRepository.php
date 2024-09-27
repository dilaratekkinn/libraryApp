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
}
