<?php

namespace App\Providers;

use App\Http\Resources\error\ErrorResource;
use App\Models\Category;
use App\Models\Wrap;
use App\Observers\CategoryObserver;
use App\Observers\WrapObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
