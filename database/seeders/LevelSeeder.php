<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("levels")->insert([
            'name'=>'KINDER',
        ]);
        DB::table("levels")->insert([
            'name'=>'PICHU',
        ]);
        DB::table("levels")->insert([
            'name'=>'AMPATO',
        ]);
        DB::table("levels")->insert([
            'name'=>'RIMO',
        ]);
        DB::table("levels")->insert([
            'name'=>'MAKALU',
        ]);
        DB::table("levels")->insert([
            'name'=>'PRE-KET',
        ]);
    }
}
