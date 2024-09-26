<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Author::truncate();
        $json = File::get("resources/json/authors.json");
        $authors = json_decode($json);

        foreach ($authors as $author) {
            Author::create([
                'id' => $author->id,
                'name' => $author->name,
                'bio' => $author->bio,
                'status' => $author->status
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
