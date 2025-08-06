<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProviderBase;

class RouteServiceProvider extends ServiceProviderBase
{
    /**
     * Where to redirect users after login/registration.
     */
    public const HOME = '/';

    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
