<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class track
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty($_COOKIE['today_visit'])) {

            // write all what you need to DB
           
            $user_id = NULL;
            $ip = $request->ip();
            if(isset(Auth::user()->id)){
                $user_id = Auth::user()->id;
            }
            DB::insert('insert into visitor (ip,user_id) values(?, ?)',[$ip,$user_id]);

            
            setcookie('today_visit', TRUE, time() + (60 * 60 * 24), '/');
        }
        return $next($request);
    }
}
