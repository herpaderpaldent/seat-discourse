<?php

namespace Herpaderpaldent\Seat\SeatDiscourse;

use Herpaderpaldent\Seat\SeatDiscourse\Commands\SyncRolesWithDiscourse;
use Herpaderpaldent\Seat\SeatDiscourse\Events\Register;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\Registrar as Router;
use Illuminate\Auth\Events\Registered as RegisterEvent;


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
        $this->addEvents();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function addEvents()
    {

        // Internal Authentication Events
        //$this->app->events->listen(RegisterEvent::class, Register::class);

    }
    private function addCommands()
    {

        $this->commands([
            SyncRolesWithDiscourse::class,
        ]);


    }
    private function addRoutes()
    {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }
}
