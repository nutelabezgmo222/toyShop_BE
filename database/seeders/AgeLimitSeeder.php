<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 0;
        $limits = [
            [0, 3],
            [3, 6],
            [6, 9],
            [0, 9],
            [9, 14],
            [9, 17],
            [15, 17]
        ];

        foreach($limits as $limit) {
            DB::table('age_limits')->insert([
                'id' => $id,
                'lower_age_limit' => $limit[0],
                'upper_age_limit' => $limit[1]
            ]);
            
            $id = $id + 1;
        }
    }
}
