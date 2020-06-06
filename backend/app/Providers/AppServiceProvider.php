<?php

namespace App\Providers;

use App\Observers\TokenObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Token;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Token::observe(TokenObserver::class);

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
