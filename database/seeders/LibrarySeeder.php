<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Library::truncate();
        $json = File::get("resources/json/libraries.json");
        $libraries = json_decode($json);

        foreach ($libraries as $library) {
            Library::create([
                'id' => $library->id,
                'name' => $library->name,
                'address' => $library->address
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
