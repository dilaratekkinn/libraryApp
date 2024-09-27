<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;

class Book extends Model
{
    use HasFactory;
    use VersionableTrait;
    protected $guarded = [];

    public function categories(){
        return $this->belongsToMany(Category::class, 'book_categories');
    }
    public function author() {
        return $this->belongsTo(Author::class);
    }

}
