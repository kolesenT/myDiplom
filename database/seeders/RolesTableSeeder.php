<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $week_days = [
            "admin",
            "pupil",
            "teacher",
            "parent",
            "user",
        ];
        foreach ($week_days as $items){
            DB::table('roles')->insert([
                'name' => $items,
            ]);
        }
    }
}
