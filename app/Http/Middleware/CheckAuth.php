<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$level)
    {
        if(auth()->check()) {
            $user = auth()->user();

            if($user->is_admin == 1 && in_array('admin', $level)) {
                return $next($request);
            }

            if($user->userTeacher != null && in_array('user', $level)) {
                return $next($request);
            }
        } else {
            if(in_array('admin', $level)) {
                return redirect()->route('login');
            }
            if(in_array('user', $level)) {
                return redirect()->route('user.login');
            }
        }

        return redirect('/');
    }
}
