<?php

namespace App\Http\Middleware;

use Closure;

class Logger
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

        // https://solomaker.club/how-handle-page-access-by-user-role/

        if(empty(auth()->user())){
            return redirect()->route('/login');
        }

        return $next($request);
    }
}
