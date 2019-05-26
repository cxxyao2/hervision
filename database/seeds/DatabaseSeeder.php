<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
         $this->call(AccountingItemsSeeder::class);
         $this->call(BilansSeeder::class);
         $this->call(ChannelsSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(ThreadsSeeder::class);
         $this->call(MonthlyOutputTableSeeder::class);
    }
}
