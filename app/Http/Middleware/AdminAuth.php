<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if (Auth::guard('api')->check()) {
            foreach (Auth::user()->userRoles as $userRole) {
                if($userRole->role_id == 4) {
                    return $next($request);
                }
            }
        }
        $message = ["message" => "You are not permitted to do this"];
        return response($message, 401);
    }
}
