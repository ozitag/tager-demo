<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

class RequestIsAjax
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!$request->ajax()) {
            return response(['Ajax pls'], 400);
        }

        return $next($request);
    }
}
