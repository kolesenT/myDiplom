<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_infoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_info')->insert([
            'code_id' => '1',
            'gender_id' => '1',
            'role_id' => '1',
            'surname' => 'Admin',
            'name' => 'admin',
        ]);
    }
}
