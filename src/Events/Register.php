<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 04.04.2018
 * Time: 20:57
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Events;

use Illuminate\Auth\Events\Registered as RegisterEvent;
use richp10\discourseAPI\DiscourseAPI;

require_once DiscourseAPI;


class Register
{



    public static function handle(RegisterEvent $event)
    {

        //First Update Roles
        //Secound Create User

        $api = new DiscourseAPI(parse_url(
            getenv('DISCOURSE_URL'),PHP_URL_HOST),
            getenv('DISCOURSE_API_KEY'),
            parse_url(getenv('DISCOURSE_URL'),PHP_URL_SCHEME));

        // create user
        $r = $api->createUser(
            $event->user->name,
            $event->user->name,
            $event->user->email,
            $event->user->character_owner_hash
            );
        print_r($r);

        // in order to activate we need the id
        $r = $api->getUserByUsername($event->user->name);
        print_r($r);

        // activate the user
        $r = $api->activateUser($r->apiresult->user->id);
        print_r($r);



        /*

        $event->user->login_history()->save(new UserLoginHistory([
            'source'     => Request::getClientIp(),
            'user_agent' => Request::header('User-Agent'),
            'action'     => 'logout',
        ]));

        $message = 'User logged out from ' . Request::getClientIp();
        event('security.log', [$message, 'authentication']);
        */
    }



}