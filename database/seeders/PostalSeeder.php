<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postals = ['Nova poshta', 'Ukr poshta'];
        $id = 1;

        foreach($postals as $postal) {
            DB::table('postals')->insert([
                'id' => $id,
                'title' => $postal,
                'Country_id' => 1
            ]);

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE postals_id_seq RESTART WITH ' .$id + 1);
    }
}
