<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 22.09.2018
 * Time: 10:47.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Http\Controllers;

use Herpaderpaldent\Seat\SeatDiscourse\Action\SeatDiscourse\GetChangelog;
use Seat\Web\Http\Controllers\Controller;

class SeatDiscourseController extends Controller
{
    public function getAbout(GetChangelog $action)
    {
        $changelog = $action->execute();

        return view('seatdiscourse::about', compact('changelog'));
    }
}
