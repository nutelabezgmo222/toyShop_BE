<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ['boy', 'girl', 'unisex'];

        foreach($genders as $gender) {
            DB::table('gender_categories')->insert([
                'id' => NULL,
                'title' => $gender
            ]);
        }
    }
}
