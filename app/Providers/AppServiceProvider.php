<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//       view()->composer('layouts.sidebar',function($view){
//          $view->with('archives',\App\Models\Post::archives());
//          $view->with('tagjs',\App\Models\Tagj::has('posts')->pluck('name'));
//       });

      View::composer('*',function($view){
          $view->with('channels',\App\Models\Channel::all());
          $view->with('tags',\App\Models\Tag::all());
      });


      Validator::extend('spamfree','App\Rules\SpamFree@passes');

      //Carbon::setLocale('en');



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
