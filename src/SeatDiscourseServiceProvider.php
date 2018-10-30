<?php

namespace Herpaderpaldent\Seat\SeatDiscourse;

use Herpaderpaldent\Seat\SeatDiscourse\Commands\SyncRolesWithDiscourse;
use Herpaderpaldent\Seat\SeatDiscourse\Observers\RefreshTokenObserver;
use Illuminate\Support\ServiceProvider;
use Seat\Eveapi\Models\RefreshToken;

class SeatDiscourseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addCommands();
        $this->addRoutes();
        $this->addViews();

        RefreshToken::observe(RefreshTokenObserver::class);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/seatdiscourse.sidebar.php', 'package.sidebar');
        $this->mergeConfigFrom(__DIR__ . '/config/seatdiscourse.config.php', 'seatdiscourse.config');

    }

    private function addCommands()
    {

        $this->commands([
            SyncRolesWithDiscourse::class,
        ]);

    }

    private function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'seatdiscourse');
    }

    private function addRoutes()
    {
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }
}
