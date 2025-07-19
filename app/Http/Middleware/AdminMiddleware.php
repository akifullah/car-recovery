<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $isAdmin = Session::get('is_admin', false);
        $loginTime = Session::get('admin_login_time', 0);
        if (!$isAdmin || (time() - $loginTime > 3600)) {
            Session::forget('is_admin');
            Session::forget('admin_login_time');
            return redirect()->route('admin.login.form')->with('error', 'Please login as admin.');
        }
        return $next($request);
    }
}
