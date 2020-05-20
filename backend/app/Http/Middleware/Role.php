<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class Role
{

    public function handle($request, Closure $next, ... $roles)
    {
        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user->$role) return $next($request);
        }

        return response(['message' => 'You do not have the access rights to view page.'], 401);
    }


}
