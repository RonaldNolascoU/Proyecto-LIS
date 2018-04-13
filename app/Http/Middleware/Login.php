<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Login
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
        if(Session::has('id')){
            return $next($request);
        }else{
            $prb = "Necesita loguearse para acceder";
            return redirect('/')->with('prb',$prb);
        }
        
    }
}
