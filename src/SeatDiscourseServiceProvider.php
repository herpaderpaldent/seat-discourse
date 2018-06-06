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
        $this->addEvents();

        $this->app['router']->group(["middleware" => ["web", "auth"]], function (Router $router) {
            $router->get($this->app['config']->get('services.discourse.route'), [
                'uses' => 'Herpaderpaldent\Seat\SeatDiscourse\Controllers\SsoController@login',
                'as'   => 'sso.login',
            ]);
        });
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

    public function addEvents()
    {

        // Internal Authentication Events
        //$this->app->events->listen(RegisterEvent::class, Register::class);

    }
    public function addCommands()
    {

        $this->commands([
            SyncRolesWithDiscourse::class,
        ]);


    }
}
