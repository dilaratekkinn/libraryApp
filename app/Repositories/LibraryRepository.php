<?php

namespace App\Repositories;

use App\Models\Library;
use Illuminate\Database\Eloquent\Model;

class LibraryRepository extends BaseRepository
{
  public function __construct(Library $model)
  {
      parent::__construct($model);
  }
}
