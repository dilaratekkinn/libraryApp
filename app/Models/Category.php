<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;


class Category extends Model
{
    use HasFactory;
    use VersionableTrait;
    protected $guarded = [];

    public function books(){
        return $this->belongsToMany(Book::class, 'book_categories');
    }
}
