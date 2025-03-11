<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class CustomThrottle
{
    public function handle(Request $request, Closure $next,  $maxAttempts = 10, $decaySeconds = 30): Response
    {
        try {
            return app(\Illuminate\Routing\Middleware\ThrottleRequests::class)
                ->handle($request, $next, $maxAttempts, $decaySeconds / 60);
        } catch (ThrottleRequestsException $exception) {
            return Redirect::route('website.429-error');
        }
    }
}
