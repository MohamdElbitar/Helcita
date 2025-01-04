<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            if ($role == 'admin' && !Auth::user()->hasRole('admin')) {
                return redirect()->route('Clinic.home');
            }
            
            if ($role == 'clinic' && !Auth::user()->hasRole('clinic')) {
                return redirect()->route('Admin.home');
            }
        }

        return $next($request);
    }
}
