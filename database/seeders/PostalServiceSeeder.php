<?php

namespace Database\Seeders;

use App\Models\Postal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postals = Postal::all();
        $id = 1;

        foreach($postals as $postal) {
            for ($j = 0; $j < 30; $j++) { 
                DB::table('postal_services')->insert([
                    'id' => $id,
                    'title' => 'Відділення №' .$j,
                    'Postal_id' => $postal['id']
                ]);

                $id = $id + 1;
            }
        }

        DB::statement('ALTER SEQUENCE postal_services_id_seq RESTART WITH ' .$id + 1);
    }
}
