<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class Passport
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $providers
     * @return mixed
     */
    public function handle($request, Closure $next, ...$providers)
    {
        if($providers) {
            Config::set('auth.guards.api.provider', array_shift($providers));
            return $next($request);
        }
        $validator = Validator::make($request->all(), [
            'provider' => 'nullable|in:users,administrators',
        ]);
        if ($validator->fails()) {
            return response(['error' => 'Bad request'], 400);
        }
        Config::set('auth.guards.api.provider', $request->get('provider') ?? 'users');
        return $next($request);
    }

}
