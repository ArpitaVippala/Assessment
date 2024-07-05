<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $proxies = '*';

        $trustedHeaders = SymfonyRequest::HEADER_X_FORWARDED_FOR | SymfonyRequest::HEADER_X_FORWARDED_HOST
                          | SymfonyRequest::HEADER_X_FORWARDED_PORT | SymfonyRequest::HEADER_X_FORWARDED_PROTO;

        // Trust the proxies and headers
        $request->setTrustedProxies([$proxies], $trustedHeaders);

        return $next($request);
    }
}
