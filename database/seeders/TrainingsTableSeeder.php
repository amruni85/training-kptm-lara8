<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainings')->insert([
            'title' => "Laravel Training - Foundation",
            'description'=>"Intoduction to Laravel, Installation and MVC Intro",
            'trainer'=>"En. Tarmizi",
        ]);
    }
}
