<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;
use App\Models\Thread;
use App\User;

class ThreadSubscription extends Model
{
    //
    protected $guarded = [];

    public function thread()
    {
      return $this->belongsTo(Thread::class,'thread_id');
    }


    public function user()
    {
      return $this->belongsTo(User::class);
    }




    public function notify($reply)
    {
      $this->user->notify(new ThreadWasUpdated($this->thread,$reply));
    }
}
