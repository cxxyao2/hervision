<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('channels')->insert([
         'name' => 'books' ,
         'slug' => 'books'
     ]);


     DB::table('channels')->insert([
         'name' => 'techs' ,
         'slug' => 'techs'
     ]);


       DB::table('channels')->insert([
          'name' => 'ledger' ,
          'slug' => 'ledger'
      ]);

        DB::table('channels')->insert([
           'name' => 'society',
           'slug' => 'society'
       ]);
    }
}
