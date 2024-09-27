<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends BaseRepository
{
  public function __construct(Book $model)
  {
      parent::__construct($model);
  }
}
