<?php

namespace App\Http\Middleware\Students;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(request()->is('student/login') || request()->is('student/register')){
            if(session()->has('student')){
                return redirect('student/dashboard');
            }
        }
        return $next($request);
    }
}
