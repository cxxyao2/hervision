<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'confirmed' => 1,
        'confirmation_token' => str_random(25)
    ];
});


use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'confirmed' => 1,
        'confirmation_token' => str_random(25)
    ];
});



// $factory->define(App\Models\Post::class, function (Faker $faker) {
//     return [
//         'user_id' => function(){
//           return  factory(App\User::class)->create()->id;
//         },
//         'postbody' => $faker->paragraph
//     ];
// });


$factory->define(App\Models\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function(){
          return  factory(App\User::class)->create()->id;
        },
        'channel_id' => function(){
          return  factory(App\Models\Channel::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'foreword'=> $faker->paragraph
    ];
});



$factory->define(App\Models\Channel::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name
    ];
});

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    return [
      'thread_id' => function(){
        return  factory(App\Models\Thread::class)->create()->id;
      },
        'user_id' => function(){
          return  factory(App\User::class)->create()->id;
        },
        'body' => $faker->paragraph
    ];
});


// $factory->define(\Illuminate\Notifications\DatabaseNofication::class,function($faker){
//   return [
//       'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
//       'type' => 'App\Notifications\ThreadWasUpdated',
//       'notifiable_id' => function(){
//         return auth()->id() ?: factory('App\User')->create()->id;
//       },
//       'notifiable_type' => 'App\User',
//       'data' =>['foo' => 'bar']
//   ];
// });




$factory->define(App\Models\Bilan::class, function (Faker $faker) {
    return [
        'user_id' => function(){
          return  factory(App\User::class)->create()->id;
        },
        'bilan_day' => Carbon::parse(now())->format('Y.m.d'),
        'inout' => '0',
        'catagory_code' => '0000',
        'item_amount' => 800,
        'item_details' => $faker->sentence,
        'visible_level' =>  0,
        'can_comment' =>  0
    ];
});
