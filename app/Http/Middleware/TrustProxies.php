<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $proxies;

    protected $headers = Request::HEADER_X_FORWARDED_ALL;
    
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
