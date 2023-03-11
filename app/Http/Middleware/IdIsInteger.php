<?php

namespace App\Http\Middleware;

use App\Utils\Response;
use Closure;
use Illuminate\Http\Request;

class IdIsInteger
{
    use Response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_numeric($request->id)) {
            return $next($request);
        }
        return $this->responseError(403);
    }
}
