<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionHasUser
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
        if (!$request->session()->exists('user_email')) {
            // user value cannot be found in session
            return redirect('/login');
        }
        return $next($request);
    }
}
