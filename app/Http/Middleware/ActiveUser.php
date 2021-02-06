<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveUser
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
        $user = Auth::guard('web')->user();
        if (!isset($user) || $user->status == 0) {
            Auth::guard('web')->logout();
            return redirect()->route('login')
                ->withError('Your account was banned ');
        }
        return $next($request);
    }
}
