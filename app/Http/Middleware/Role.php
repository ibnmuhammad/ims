<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, String $role)
    {
        if (!Auth::check())                                 //not necessary as it is a part of 'auth' middleware
        return redirect('/welcome');

        $user = Auth::user();
        if ($user->role == $role)
        return $next($request);

        return redirect ('/welcome');
    }
}
