<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
     'name' => 'Jane1',
     'email' => 'jane1@hervison2019.com',
     'password' => Hash::make('q12%L78&')
  ]);

  DB::table('users')->insert([
     'name' => 'Jane2',
     'email' => 'jane2@hervison2019.com',
     'password' => Hash::make('12345678')
  ]);


    }
}
