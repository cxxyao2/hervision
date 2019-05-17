<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //personelle
      DB::table('tags')->insert([
         'name' => 'personelle'
      ]);
      //php
      DB::table('tags')->insert([
         'name' => 'php'
      ]);
      //jquery
      DB::table('tags')->insert([
         'name' => 'jquery'
      ]);
      //javascript
      DB::table('tags')->insert([
         'name' => 'javascript'
      ]);
      //Laravel
      DB::table('tags')->insert([
         'name' => 'Laravel'
      ]);
      //ajax
      DB::table('tags')->insert([
         'name' => 'ajax'
      ]);
      //vue.js
      DB::table('tags')->insert([
         'name' => 'vue.js'
      ]);

    }
}
