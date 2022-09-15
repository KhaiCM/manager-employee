<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return defineResponse(
                    __('messages.token.invalid'),
                    Response::HTTP_BAD_REQUEST
                );
            } else if ($e instanceof TokenExpiredException) {
                return defineResponse(
                    __('messages.token.expired'),
                    Response::HTTP_BAD_REQUEST
                );
            } else {
                return defineResponse(
                    __('messages.token.not_found'),
                    Response::HTTP_BAD_REQUEST
                );
            }
        }

        return $next($request);
    }
}
