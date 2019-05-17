<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Tag;
use App\Models\ThreadSubscription;




class Thread extends Model
{


    use  RecordsActivity , RecordsVisits;
    //protected $fillable = ['user_id','channel_id','title','body'] ;
    protected $guarded = [];
    protected $with = ['creator','channel'];

    protected $appends = ['isSubscribedTo'];
    //protected $hidden = ['id']; //todo



    //boot the model
    protected static function boot()
    {
      parent::boot();



      static::deleting(function($thread){
          $thread->replies->each->delete();

      });

    }




    //proteced $guardes = [];
    public function path()
    {
      return "/threads/{$this->channel->slug}/{$this->id}";
    }


    public function replies()
    {
      return $this->hasMany(Reply::class);

    }

    public function channel()
    {
      return $this->belongsTo(Channel::class);
    }

    public function creator()
    {
      return $this->belongsTo(User::class,'user_id');

    }

    public function addReply($reply)
    {
       $reply = $this->replies()->create($reply);


       //prepare notifications for all subscribes
       $this->subscriptions->filter(function($sub) use ($reply){
         return $sub->user_id != $reply->user_id;
       })
        ->each->notify($reply);


       return $reply;


    }

    public function lock()
    {
      $this->update(['locked' => true ]);

    }

    public function unlock(){
      $this->update(['locked' => false]);
    }

    public function unsubscribe($userId = null)
    {
      return $this->subscriptions()
      ->where('user_id',$userId ?: auth()->id())
      ->delete();

    }
    public function subscribe($userId = null)
    {
       $this->subscriptions()->create([
          'user_id' => $userId ?: auth()->id()
        ]);
        return $this;
    }

    public function subscriptions()
    {
      return $this->hasMany(ThreadSubscription::class);

    }

    public function scopeFilter($query, $filters)
    {
      return $filters->apply($query);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
                ->where('user_id',auth()->id())
                ->exists();
    }

    public function hasUpdatesFor($user =  null)
    {
    //  $key = sprintf("users.%s.visits.%s", auth()->id(),$this->id);

      $key = $user->visitedThreadCacheKey($this);
      return $this->updated_at > cache($key);
    }

    public function  tags()
    {
      return $this->belongsToMany(Tag::class,'thread_tag');
    }



}
