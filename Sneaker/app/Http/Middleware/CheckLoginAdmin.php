<?php

namespace App\Http\Middleware;

session_start();

use Closure;

class CheckLoginAdmin
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
        if(isset($_SESSION['user'])){
            return $next($request);
        }else{
            return redirect('/admin/login');
        }
    }
}
