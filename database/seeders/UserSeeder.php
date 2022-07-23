<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersToCreate = 20;
        $id = 1;

        for($i = 0; $i < $usersToCreate; $i++) {
            DB::table('users')->insert([
                'id' => $id,
                'name' => Str::random(10),
                'surname' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => intval('380' . rand(100000000, 999999999)),
                'registration_date' => date("Y-m-d H:i:s"),
                'last_log_time' => date("Y-m-d H:i:s"),
                'is_admin' => 0,
            ]);
            
            $id = $id + 1;
        }

        DB::table('users')->insert([
            'id' => $id,
            'name' => 'Maxim',
            'surname' => 'Solod',
            'email' => 'test@i.ua',
            'password' => '12332111',
            'phone_number' => intval('380' . rand(100000000, 999999999)),
            'registration_date' => date("Y-m-d H:i:s"),
            'last_log_time' => date("Y-m-d H:i:s"),
            'is_admin' => 1,
        ]);

        $id = $id + 1;

        DB::statement('ALTER SEQUENCE users_id_seq RESTART WITH ' .$id + 1);
    }
}