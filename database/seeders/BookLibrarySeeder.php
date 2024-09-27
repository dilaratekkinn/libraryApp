<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use App\Models\BookLibrary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BookLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        BookLibrary::truncate();
        $json = File::get("resources/json/bookLibraries.json");
        $datas = json_decode($json);

        foreach ($datas as $data) {
            BookLibrary::create([
                'book_id' => $data->book_id,
                'library_id' => $data->library_id,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
