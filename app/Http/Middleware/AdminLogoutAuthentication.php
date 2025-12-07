<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLogoutAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session()->has('admin_session')){
            session(['showAdminLogoutAlert' => true]);
            return redirect('/Logout_Error')->with('alert', 'To access further pages, please Logout first');
        }else{
            return $next($request);
        }
    }
}
