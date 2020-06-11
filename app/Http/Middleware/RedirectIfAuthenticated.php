<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            if(auth()->user()->user_type == \App\User::USER_FREELANCER){
                $path = '/freelancer/dashboard';
            }else{
                $path =  '/employer/dashboard';
            }
            
            return redirect($path);
        }

        return $next($request);
    }
}
