<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1, $time_start = 9; $i < 8; $i++, $time_start++){
            DB::table('num_lessons')->insert([
                'num' => $i,
                'begin_time' => $time_start,
                'lesson_time' => 45,
            ]);
        }
    }
}
