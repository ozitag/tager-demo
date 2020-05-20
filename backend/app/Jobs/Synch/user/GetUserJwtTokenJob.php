<?php


namespace App\Jobs\Synch\user;

use Firebase\JWT\JWT;

class GetUserJwtTokenJob
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(){
        $this->user->update([
            'auth_token' => JWT::encode([
                'id' => $this->user->id
            ], config('auth.jwt.secret_key'), config('auth.jwt.algorithm'))
        ]);
    }
}
