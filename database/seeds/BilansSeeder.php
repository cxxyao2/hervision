<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BilansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('bilans')->insert([
          'user_id' => 1,
          'bilan_day' => '2018/11/20',
          'inout_flag' => '0',
          'catagory_code' => '0000',
          'item_amount' => 1000,
          'item_details' => '惊喜',
          'visible_level' =>  0,
          'can_comment' =>  0
      ]);

      DB::table('bilans')->insert([
         'user_id' => 1,
         'bilan_day' => '2018/11/20',
         'inout_flag' => '0',
         'catagory_code' => '0001',
         'item_amount' => 1000,
         'item_details' => '平',
         'visible_level' =>  0,
         'can_comment' =>  0
     ]);

       DB::table('bilans')->insert([
          'user_id' => 1,
          'bilan_day' => '2018/11/20',
          'inout_flag' => '0',
          'catagory_code' => '0002',
          'item_amount' => 1000,
          'item_details' => '持平',
          'visible_level' =>  0,
          'can_comment' =>  0
      ]);

      DB::table('bilans')->insert([
         'user_id' => 1,
         'bilan_day' => '2018/11/20',
         'inout_flag' => '1',
         'catagory_code' => '0100',
         'item_amount' => 1000,
         'item_details' => '10%涨幅',
         'visible_level' =>  0,
         'can_comment' =>  0
     ]);

     DB::table('bilans')->insert([
        'user_id' => 1,
        'bilan_day' => '2018/11/20',
        'inout_flag' => '1',
        'catagory_code' => '0101',
        'item_amount' => 1000,
        'item_details' => '无',
        'visible_level' =>  0,
        'can_comment' =>  0
    ]);

    DB::table('bilans')->insert([
       'user_id' => 1,
       'bilan_day' => '2018/11/20',
       'inout_flag' => '1',
       'catagory_code' => '0102',
       'item_amount' => 1000,
       'item_details' => '涨50%',
       'visible_level' =>  0,
       'can_comment' =>  0
    ]);


   DB::table('bilans')->insert([
      'user_id' => 2,
      'bilan_day' => '2018/11/20',
      'inout_flag' => '0',
      'catagory_code' => '0000',
      'item_amount' => 1000,
      'item_details' => '惊喜',
      'visible_level' =>  0,
      'can_comment' =>  0
  ]);

  DB::table('bilans')->insert([
     'user_id' => 2,
     'bilan_day' => '2018/11/20',
     'inout_flag' => '0',
     'catagory_code' => '0001',
     'item_amount' => 1000,
     'item_details' => '平',
     'visible_level' =>  0,
     'can_comment' =>  0
 ]);

   DB::table('bilans')->insert([
      'user_id' => 2,
      'bilan_day' => '2018/11/20',
      'inout_flag' => '0',
      'catagory_code' => '0002',
      'item_amount' => 1000,
      'item_details' => '持平',
      'visible_level' =>  0,
      'can_comment' =>  0
  ]);

  DB::table('bilans')->insert([
     'user_id' => 2,
     'bilan_day' => '2018/11/20',
     'inout_flag' => '1',
     'catagory_code' => '0100',
     'item_amount' => 1000,
     'item_details' => '10%涨幅',
     'visible_level' =>  0,
     'can_comment' =>  0
 ]);

 DB::table('bilans')->insert([
    'user_id' => 2,
    'bilan_day' => '2018/11/20',
    'inout_flag' => '1',
    'catagory_code' => '0101',
    'item_amount' => 1000,
    'item_details' => '无',
    'visible_level' =>  0,
    'can_comment' =>  0
]);

DB::table('bilans')->insert([
   'user_id' => 2,
   'bilan_day' => '2018/11/20',
   'inout_flag' => '1',
   'catagory_code' => '0102',
   'item_amount' => 1000,
   'item_details' => '涨50%',
   'visible_level' =>  0,
   'can_comment' =>  0
]);


    }
}
