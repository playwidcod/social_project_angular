<?php

namespace App\Http\Middleware;

use Closure;
use larav_model;
use session;
use auth;
class ck_session
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
        if(session()->get('email') == null){
            return $next($request);
        }else{
           return redirect('/');
        }
    }
}
class ck_session1
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
        if(session()->get('email') !== null){
            return $next($request);
        }else{
           return redirect('/login');
        }
    }
}
