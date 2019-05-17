<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Thread;
use App\Models\Activity;
use App\Models\Reply;
use App\Models\Bilan;
use App\Models\Pollj;
use Carbon\Carbon;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable  
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar_path','confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email'
    ];



    //boot the model
    protected static function boot()
    {
      parent::boot();
      static::deleting(function($user){
          $user->threads->each->delete();
          $user->bilans->each->delete();
          $user->polljs->each->delete();

      });

    }


    //得到自己关注的所有人
    public function myFollowed()
    {
      //foreign-key,local-key
      return $this->hasMany(Follow::class,'followed_id','id');
    }



    //确认自己是否关注了某人
    public function isFollowed($followed_id)
    {
      //foreign-key,local-key
      return  DB::table('follows')->where([
        ['followed_id', '=', $followed_id],
        ['following_id', '=', $this->id],
      ])->exists();

    }


    public function bilans(){
      return $this->hasMany(Bilan::class);
    }

    public function polljs(){
      return $this->hasMany(Pollj::class);
    }

   


    //
    public function threads()
    {
      return  $this->hasMany(Thread::class)->latest();
    }



    public function lastReply(){
      return $this->hasOne(Reply::class)->latest();
    }

    /**
    * Get the route key name for Laravel
    *
    *@return string
    */
    public function getRouteKeyName()
    {
      return 'name'; //username
    }



    public function activity()
    {
      return $this->hasMany(Activity::class);
    }

    public function read($thread)
    {
      cache()->forever(
        $this->visitedThreadCacheKey($thread),
        Carbon::now()
      );
    }

    public function visitedThreadCacheKey($thread)
    {
      return sprintf("users.%s.visits.%s",$this->id,$thread->id);
    }

    public function avatar()
    {
      //return $this->avatar_path?:'/storage/avatars/default.jpg';
      if ((is_null($this->avatar_path)) || (empty($this->avatar_path))) {
        return '/storage/avatars/default.jpg';
      }
      return '/storage/'.$this->avatar_path;
    }


    public function isAdmin()
    {
      return in_array($this->name,['Jane1','Jane2','Jane3']);
    }


    public function lock()
    {
      $this->locked = 1;
      return $this->save();

    }

    public function unlock(){
      $this->locked = 0;
      return $this->save();
    }


    public function islocked(){
     return $this->locked ==  1;

    }


    public function isOnline(){
      return Cache::has('user-is-online-'.$this->id);
    }

    public function confirm() {
      $this->confirmed = 1;
      $this->confirmation_token = null;
      $this->save();
      
    }
}
