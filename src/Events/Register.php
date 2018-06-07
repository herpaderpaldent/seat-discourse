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

    }



}