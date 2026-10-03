<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalDomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Ensures 301 permanent redirect from www to non-www for SEO canonicalization.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (str_starts_with($host, 'www.')) {
            $canonicalHost = substr($host, 4);
            $targetUrl = 'https://' . $canonicalHost . $request->getRequestUri();

            return redirect()->to($targetUrl, 301);
        }

        return $next($request);
    }
}
