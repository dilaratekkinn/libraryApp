<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use VersionableTrait;
    protected $guarded = [];

    public function categories(){
        return $this->belongsToMany(Category::class, 'book_categories');
    }
    public function getAuthor() {
        return $this->belongsTo(Author::class,'author_id','id');
    }
    public function libraries(){
        return $this->belongsToMany(Library::class, 'book_libraries');
    }
}
