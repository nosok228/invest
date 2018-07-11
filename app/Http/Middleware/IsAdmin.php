<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class IsAdmin
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
        $userId = Auth::user()->id;

        $result = Admin::where('user_id', $userId)->first();

        if($result) {
            return $next($request);
        }
        else {
            abort(404);
        }
        
    }
}
