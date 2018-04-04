<?php

namespace Herpaderpaldent\Seat\SeatDiscourse;

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

    public function add_events()
    {

        // Internal Authentication Events
        $this->app->events->listen(RegisterEvent::class, Register::class);


    }
}
