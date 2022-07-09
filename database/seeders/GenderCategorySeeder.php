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
        $id = 1;

        foreach($genders as $gender) {
            DB::table('gender_categories')->insert([
                'id' => $id,
                'title' => $gender
            ]);

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE gender_categories_id_seq RESTART WITH ' .$id);
    }
}
