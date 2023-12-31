<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert([
            'part_number' => '1234',
            'part_name' => 'Wiring Harness',
            'supplier' => 'PT. SASAONGKO JAYA MAKMOERS',
            'dimension' => '200 x 300 x 450',
            'judgement' => 'OK'
        ]);
        DB::table('parts')->insert([
            'part_number' => '1233',
            'part_name' => 'Hub Set Wheels',
            'supplier' => 'PT. RESTU WAHANA',
            'dimension' => '200 x 300 x 450',
            'judgement' => 'OK'
        ]);
        DB::table('parts')->insert([
            'part_number' => '2232',
            'part_name' => 'Rear Wiper',
            'supplier' => 'PT. MUKLISINA',
            'dimension' => '200 x 300 x 450',
            'judgement' => 'OK'
        ]);
    }
}
