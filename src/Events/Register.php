<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 04.04.2018
 * Time: 20:57
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Events;

use Illuminate\Auth\Events\Registered as RegisterEvent;


class Register
{
    public static function handle(RegisterEvent $event)
    {

        $event->user->login_history()->save(new UserLoginHistory([
            'source'     => Request::getClientIp(),
            'user_agent' => Request::header('User-Agent'),
            'action'     => 'logout',
        ]));

        $message = 'User logged out from ' . Request::getClientIp();
        event('security.log', [$message, 'authentication']);

    }

}