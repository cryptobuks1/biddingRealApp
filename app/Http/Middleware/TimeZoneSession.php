<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class TimeZoneSession
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



   // echo session('ClientTimezone');
 
    if (session('ClientTimezone')==null || empty(session('ClientTimezone'))) {
        return redirect('/'); 
    }
      


        return $next($request);
    }
}
