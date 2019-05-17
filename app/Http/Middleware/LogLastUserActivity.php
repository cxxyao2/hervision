<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\GuestHistory;


class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $expiresAt = Carbon::now()->addMinutes(config('constants.expire_minute'));

        if(Auth::check()){
            $keytemp = 'user-is-online-'.(Auth::user()->id);
            Cache::put($keytemp,true,$expiresAt);

          //return  dd(Cache::has('user-is-online-'.(Auth::user()->id)));
        }else{
            $key = 'guest-is-online-'.(request()->getClientIp());
            $findGuest = Cache::get($key);
            $guestexpiresAt = Carbon::now()->addMinutes(config('constants.guest_expire_minute'));
            if (empty($findGuest) || is_null($findGuest)){
              $guest1 = new GuestHistory;
              $guest1 -> key = request()->getClientIp();
              $guest1 -> value = true;
              $guest1 -> expiration = $guestexpiresAt;
              $guest1->save();

            }
              Cache::put($key,true,$guestexpiresAt);
        }
        return $next($request);
        }
}
