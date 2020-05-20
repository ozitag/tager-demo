<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->mapAdminApiRoutes();

        $this->mapApiRoutes();

        $this->mapPublicApiRoutes();
    }

    protected function mapAdminApiRoutes()
    {
        Route::namespace($this->namespace)
            ->prefix('admin')
            ->middleware(['passport:administrators', 'auth:api'])
            ->group(base_path('routes/api/api.admin.php'));
    }

    protected function mapPublicApiRoutes()
    {
        Route::namespace($this->namespace)
            ->group(base_path('routes/api/api.guest.php'));
    }

    protected function mapApiRoutes()
    {
        Route::namespace($this->namespace)
            ->middleware(['passport:users', 'auth:api'])
            ->group(base_path('routes/api/api.php'));
    }
}
