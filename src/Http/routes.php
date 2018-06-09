<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 08.06.2018
 * Time: 22:14
 */

Route::group([
    'namespace' => 'Herpaderpaldent\Seat\SeatDiscourse\Http\Controllers'
], function (){
    Route::group([
        'middleware' => ['web', 'auth']
    ], function (){
        Route::get('discourse/sso', [
            'uses' => 'SsoController@login',
            'as'   => 'sso.login',
        ]);
    });
});

/*
 * ToDo: Delete this if working
 * $this->app['router']->group(["middleware" => ["web", "auth"]], function (Router $router) {
            $router->get($this->app['config']->get('services.discourse.route'), [
                'uses' => 'Herpaderpaldent\Seat\SeatDiscourse\Controllers\SsoController@login',
                'as'   => 'sso.login',
            ]);
        });
 */