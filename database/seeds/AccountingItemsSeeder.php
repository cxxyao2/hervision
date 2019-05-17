<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('accounting_items')->insert([
       'user_id' => 1,
       'catagory_code' => '0000',
       'catagory_name' => '工资'
   ]);
    DB::table('accounting_items')->insert([
        'user_id' => 1,
        'catagory_code' => '0001',
        'catagory_name' => '奖金'
    ]);
   DB::table('accounting_items')->insert([
      'user_id' => 1,
      'catagory_code' => '0002',
      'catagory_name' => '专栏写作'
  ]);
   DB::table('accounting_items')->insert([
     'user_id' => 1,
     'catagory_code' => '0100',
     'catagory_name' => '房贷'
   ]);
   DB::table('accounting_items')->insert([
    'user_id' => 1,
    'catagory_code' => '0101',
    'catagory_name' => '食物'
    ]);
   DB::table('accounting_items')->insert([
   'user_id' => 1,
   'catagory_code' => '0102',
   'catagory_name' => '教育'
    ]);
    }
}
