<?php
// app/Http/Middleware/CheckUserType.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $userType
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if (Auth::check() && Auth::user()->user_type === $userType) {
            return $next($request);
        }

        return redirect('/'); // Redirect to a default page if the user does not have the required role
    }
}
