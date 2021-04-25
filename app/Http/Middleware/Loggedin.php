<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Loggedin
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
        if (!session()->has('Loggedin')) {
            return redirect('/')->with(session(['message' => 'You must log-in first!','background' => 'bg-warning'])); 
        } 

        //This is requerd for middleware to work. DO NOT DELETE THIS!!!
        return $next($request);
        
    }
}
