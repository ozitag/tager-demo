<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\UploadedFileFactory;
use League\OAuth2\Server\ResourceServer;
use Laravel\Passport\Token;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Response;

class Passport
{
    private $server;

    public function __construct(ResourceServer $server)
    {
        $this->server = $server;
    }

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
        if ($providers) {
            Config::set('auth.guards.api.provider', array_shift($providers));
            return $this->validateAccessToken($request) ?
                $next($request) : response(['message' => Response::$statusTexts[401]], 401);
        }

        $validator = Validator::make($request->all(), [
            'provider' => 'nullable|in:users,administrators',
        ]);

        if ($validator->fails()) {
            return response(['error' => 'Bad request'], 400);
        }

        Config::set('auth.guards.api.provider', 'administrators');

        return $next($request);
    }


    private function validateAccessToken($request)
    {
        $psr = (new PsrHttpFactory(
            new ServerRequestFactory,
            new StreamFactory,
            new UploadedFileFactory,
            new ResponseFactory
        ))->createRequest($request);

        try {
            $psr = $this->server->validateAuthenticatedRequest($psr);
            $token_id = $psr->getAttribute('oauth_access_token_id');
            if ($token_id) {
                $access_token = Token::whereId($token_id)
                    ->whereProvider(Config::get('auth.guards.api.provider'))
                    ->first();
            }
        } catch (\Exception $e) {

        }
        return isset($access_token) && $access_token ? true : false;
    }
}
