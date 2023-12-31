<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nik' => 2349,
            'name' => 'Fulan',
            'role' => 'admin',
            'email' => 'fualan@gmail.com',
            'password' => bcrypt('111111')
        ]);
        DB::table('users')->insert([
            'nik' => 1344,
            'name' => 'Pak Pria',
            'role' => 'general_user',
            'email' => 'pria@gmail.com',
            'password' => bcrypt('111111')
        ]);
    }
}
