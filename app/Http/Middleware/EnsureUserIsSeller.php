<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'seller')
        {
            if(!(request()->segment(1) == 'seller' && (request()->segment(2) == 'profile') && ((request()->segment(3) == 'seller-info') || (request()->segment(3) == 'business-info')))) {
                if(is_null(Auth::user()->seller) || empty(Auth::user()->seller->name)) {
                    return redirect('seller/profile/seller-info');
                }
                if(is_null(Auth::user()->seller) || empty(Auth::user()->seller->area_id)) {
                    return redirect('seller/profile/business-info');
                }
            }
            
            return $next($request);
        }
        Auth::logout();
        return redirect('portal/login');
    }
}
