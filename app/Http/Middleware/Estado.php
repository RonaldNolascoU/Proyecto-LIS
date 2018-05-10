<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Estado
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
        if(Auth::user()->estado == 2){
            Auth::logout();
            $prb = "Ya no tiene permitido el acceso";
            return redirect('/login')->with('prb',$prb);
        }
        return $next($request);
    }
}
