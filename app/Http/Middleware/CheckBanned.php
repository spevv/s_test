<?php

namespace App\Http\Middleware;

use App\Blacklist;
use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckBanned
 * @package App\Http\Middleware
 */
class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Blacklist::isBanned($request->ip())) {
            // or use throw new error
            return response('Your IP address in the blacklist.', 400);
        }

        return $next($request);
    }
}
