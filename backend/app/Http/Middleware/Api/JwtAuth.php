<?php

namespace App\Http\Middleware\Api;

use App\Models\Administrator;
use Closure;
use App\Models\AuthClient;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if ($token) {
            try {
                $token = JWT::decode($token, config('auth.jwt.secret_key'), [config('auth.jwt.algorithm')]);
            } catch (\Exception $e) {
                return response(['message' => 'Invallid authorization token'], 401);
            }
            $user = Administrator::find($token->id);
            if(!$user) {
                return response(['message' => 'User has been deleted'], 401);
            }
            Auth::login($user);
            return $next($request);
        }
        return response(['message' => 'Only Bearer authorization supported'], 401);
    }
}
