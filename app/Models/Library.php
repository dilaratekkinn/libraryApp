<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;


class Library extends Model
{
    use HasFactory;
    use VersionableTrait;
    protected $guarded = [];



    public function getBooks(){

        return $this->hasMany(Book::class);
    }
}
