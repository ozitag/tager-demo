<?php

namespace App\Features\Admin;

use App\Features\Feature;
use App\Http\Requests\Core\AuthRequest;
use App\Http\Resources\user\UserResource;
use App\Jobs\Synch\user\GetUserJwtTokenJob;
use App\Models\Administrator;

class LoginFeature extends Feature
{
    public function handle(AuthRequest $request)
    {
        $user = Administrator::whereEmail($request->email)->first();

        if (!$user) {
            return response([
                'errors' => [
                    'password' => 'Invalid credentials'
                ]
            ], 400);
        }

        if (!password_verify($request->password, $user->password)) {
            return response([
                'errors' => [
                    'password' => 'Invalid credentials'
                ]
            ], 400);
        }

        $this->run(GetUserJwtTokenJob::class, [
            'user' => $user
        ]);

        return new UserResource($user);
    }
}
