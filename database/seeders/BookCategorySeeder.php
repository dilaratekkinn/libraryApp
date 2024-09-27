<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        BookCategory::truncate();
        $json = File::get("resources/json/bookCategories.json");
        $datas = json_decode($json);

        foreach ($datas as $data) {
            BookCategory::create([
                'book_id' => $data->book_id,
                'category_id' => $data->category_id,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
