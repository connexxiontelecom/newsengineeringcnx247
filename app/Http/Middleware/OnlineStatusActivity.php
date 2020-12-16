<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Cache;
use Auth;
use Carbon\Carbon;

class OnlineStatusActivity
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
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online'.Auth::user()->id, true, $expiresAt);
             User::where('id', Auth::user()->id)->where('tenant_id', Auth::user()->tenant_id)
								->update(['last_seen'=>(new \DateTime())->format("Y-m-d H:i:s"), 'is_online'=>1]);
								$users = User::where('tenant_id', Auth::user()->tenant_id)->get();
								foreach($users as $user){
									if(!Cache::get('user-is-online'.$user->id) ){
										$user->is_online = 0;
										$user->save();
									}
								}
        }
        return $next($request);
    }
}
