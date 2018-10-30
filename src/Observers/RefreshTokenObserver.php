<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 22.09.2018
 * Time: 10:33.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Observers;

use Herpaderpaldent\Seat\SeatDiscourse\Jobs\Logout;
use Seat\Eveapi\Models\RefreshToken;

class RefreshTokenObserver
{
    public function deleting(RefreshToken $refresh_token)
    {
        logger()->debug('SoftDelete detected of ' . $refresh_token->user->name);

        dispatch(new Logout($refresh_token->user->group));

    }
}
