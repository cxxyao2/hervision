<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthlyOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2018',
            'monthname' => '01',
            'salesoutput' => 1000
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2018',
            'monthname' => '02',
            'salesoutput' => 1000
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2018',
            'monthname' => '03',
            'salesoutput' => 1500
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2018',
            'monthname' => '04',
            'salesoutput' => 1000
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2019',
            'monthname' => '01',
            'salesoutput' => 1400
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2019',
            'monthname' => '02',
            'salesoutput' => 1600
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2019',
            'monthname' => '03',
            'salesoutput' => 1600
            ]);
        DB::table('monthly_outputs')->insert([
            'user_id' => '2',
            'yearname' => '2019',
            'monthname' => '04',
            'salesoutput' => 1800
            ]);

    }
}
