<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IPValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $allowed_ips = ['127.0.0.1'];
        if (!in_array($request->ip(), $allowed_ips)) {
            return response()->json(['error' => 'Unauthorized IP'], 403);
        }
        return $next($request);
    }
}
