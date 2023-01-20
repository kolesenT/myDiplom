<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desc = [
            "Математика",
            "Русский язык",
            "Русская литература",
            "Белорусский язык",
            "Белорусская литература",
            "Биология",
            "Химия",
            "Информатика",
            "Физика",
            "Физ. культура",
            "Труд",
            "История Беларуси",
            "История Всемирная",
            "Георгафия",
            "ОБЖ",
            "Классный час",
            "Начальные классы",
        ];
        foreach ($desc as $items){
            DB::table('disciplines')->insert([
                'title' => $items,
            ]);
        }
    }
}
