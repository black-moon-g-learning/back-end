<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpiredTrial
{
    /**
     * checkExpiredTrail
     *
     * If expired trial day return false; opposite return true
     * @return bool
     */
    public function checkExpiredTrail()
    {
        $user =  Auth::user();
        $expiredUser = Carbon::parse($user->expired);
        $now = Carbon::now();

        if ($user->expired == null || $expiredUser >= $now) {
            return true;
        }
        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->checkExpiredTrail()) {
            return $next($request);
        }
        return redirect()->route('errors.expired-trial');
    }
}
