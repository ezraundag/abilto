<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        if( $this->logoutWhenSessionTokenIsChanged( $request, $guard) ) {
            return redirect()->guest('login');
        }
        
        return $next($request);
    }
    
    /**
     * Log out user when session token is changed
     *  
     * @param type $guard
     * @return boolean
     */
    protected function logoutWhenSessionTokenIsChanged( $request, $guard ) {
        if( Auth::guard($guard)->user()->user_session_token
                && Auth::guard($guard)->user()->user_session_token!=$request->session()->get('user_session_token') ) {
            Auth::guard($guard)->logout();
            return true;
        }
        return false;
    }
}
