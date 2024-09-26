<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        $json = File::get("resources/json/categories.json");
        $categories = json_decode($json);

        foreach ($categories as $category) {
            Category::create([
                'id' => $category->id,
                'name' => $category->name,
                'status' => $category->status
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
