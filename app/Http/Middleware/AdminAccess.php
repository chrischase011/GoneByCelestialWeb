<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminAccess
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
        if(!Auth::check())
        {
            return abort('404');
        }
        else{
            if(Auth::user()->roles != '1')
            {
                return abort(403, 'Are you lost baby girl?');
            }
        }

        return $next($request);
    }
}
