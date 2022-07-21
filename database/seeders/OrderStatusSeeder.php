<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Waiting for approving', 'Approved', 'Closed'];
        $id = 1;

        foreach($statuses as $status) {
            DB::table('order_statuses')->insert([
                'id' => $id,
                'title' => $status,
            ]);

            $id = $id + 1;
        }

        DB::statement('ALTER SEQUENCE order_statuses_id_seq RESTART WITH ' .$id + 1);
    }
}
