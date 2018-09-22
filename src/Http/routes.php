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
        Route::get('discourse', [
            'uses' => 'SsoController@redirect',
            'as'   => 'sso.forum',
        ]);
        Route::get('discourse/about', [
            'uses' => 'SeatDiscourseController@getAbout',
            'as'   => 'seatdiscourse.about',
        ]);
    });
});