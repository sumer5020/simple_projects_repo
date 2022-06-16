<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Cache;
use App\Models\chat_message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserActiveStatus
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
        //handle user active status
        if(Auth::check()){
            //check if user blocked or not
            if(Auth::user()->status == 0){
                Auth::guard()->logout();
                $request->session()->invalidate();
                return redirect('/');
            }
            //update chat count
            $unAnswersCount=chat_message::where('status',0)->whereNotIn('sender_id',User::AllAdmin()->get('id'))->get()->count();
            session()->flash('unAnswersCount',$unAnswersCount);
            //$exAt=expire Date
            $exAt=Carbon::now()->addMinutes(1);
            Cache::put('userActive_'.Auth::user()->id,true,$exAt);
            $profile=Auth::user()->profile;
            $profile->browser=get_browser()->browser.' '.get_browser()->version.' '.get_browser()->device_type;
            $profile->platform=get_browser()->platform;
            Auth::user()->profile()->save($profile);
        }
        return $next($request);
    }
}
