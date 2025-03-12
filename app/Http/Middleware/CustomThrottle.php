<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;

class CustomThrottle
{
    public function handle(Request $request, Closure $next, $maxAttempts = 10, $decaySeconds = 30): Response
    {
        $key = $this->resolveRequestKey($request);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return Redirect::route('website.429-error');
        }

        RateLimiter::hit($key, $decaySeconds);

        return $next($request);
    }

    private function resolveRequestKey(Request $request): string
    {
        if (auth()->check()) {
            return 'throttle-user-' . auth()->id();
        }
        return 'throttle-ip-' . $request->ip();
    }
}
