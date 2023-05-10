<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class OnlyAcceptJson
{
    /**
     * We only accept json
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (
            in_array($request->getMethod(), [Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH])
            && (!$request->expectsJson() || !Str::contains($request->header('Content-type'), 'application/json'))
        ) {
            return response(['message' => 'Only JSON requests are allowed'], Response::HTTP_NOT_ACCEPTABLE);
        }

        return $next($request);
    }
}
