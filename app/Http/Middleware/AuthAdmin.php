<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info(Auth::check());
        if(Auth::check()){
            if(Auth::user()->role_id === 1){
                return $next($request);
            }else{
                Auth::logout();
                return to_route('admin.login');
            }
        }else{
            Log::info('else part in middleware'.Auth::check());
            return to_route('admin.login')->with('error','Failed to Login');
        }
    }
}
