<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();


        $json = File::get("resources/json/users.json");
        $users = json_decode($json);

        foreach ($users as $user) {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($user->password),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
