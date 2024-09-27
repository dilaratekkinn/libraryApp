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
}
