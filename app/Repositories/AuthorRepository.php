<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class AuthorRepository extends BaseRepository
{
  public function __construct(Author $model)
  {
      parent::__construct($model);
  }
}
