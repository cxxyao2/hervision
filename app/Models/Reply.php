<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
//use Favoritable, RecordsActivity;

class Reply extends Model
{

  use Favoritable,RecordsActivity;

    protected $guarded = [];
    protected $with = ['owner','favorites'];
    protected $appends = ['favoritesCount','isFavorited'];

    protected static function boot()
    {
      parent::boot();

      static::created(function($reply)
      {
        $reply->thread->increment('replies_count');
      });


      static::deleted(function($reply)
      {
        $reply->thread->decrement('replies_count');
      });


    }



    public function owner()
    {
      return $this->belongsTo(User::class,'user_id');
    }

    public function thread()
    {
      return $this->belongsTo(Thread::class);
    }

    public function comments(){
      return $this->hasMany(Reply::class,'parent_id','id');
    }



    public function wasJustPublished()
    {
      return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function path()
    {
      return $this->thread->path() . "#reply-{$this->id}";
    }



}
