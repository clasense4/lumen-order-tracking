<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\ResponseHelpers;
use Illuminate\Http\Response;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');
        if (empty($token)) {
            return response()->json(ResponseHelpers::returnJson(400, 'Token Needed.'));
        }
        if ($token !== env('ADMIN_TOKEN')) {
            return response()->json(ResponseHelpers::returnJson(400, 'Wrong Token.'));
        } else {
            return $next($request);
        }
    }
}
