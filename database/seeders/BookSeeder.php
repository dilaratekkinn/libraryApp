<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Book::truncate();
        $json = File::get("resources/json/books.json");
        $books = json_decode($json);
        foreach ($books as $book) {
            Book::create([
                'id' => $book->id,
                'name' => $book->name,
                'subtitle' => $book->subtitle,
                'summary' => $book->subtitle,
                'cover_image' => $book->cover_image,
                'author_id'=>$book->author_id,
                'category_id'=>$book->category_id,
                'library_id'=>$book->library_id,
                'published_year'=>$book->published_year,
                'is_active'=>$book->is_active,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
