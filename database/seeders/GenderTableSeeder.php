<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'М',
            'Ж'
        ];
        foreach ($arr as $item)
        {
            DB::table('gender')->insert([
                'gender' => $item,
            ]);
        }
    }
}
