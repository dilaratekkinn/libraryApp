<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;

class BookCategory extends Model
{
    use HasFactory;
    use VersionableTrait;

    protected $guarded = [];

}
