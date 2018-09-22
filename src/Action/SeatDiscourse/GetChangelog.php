<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 22.09.2018
 * Time: 10:51
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\SeatDiscourse;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Parsedown;

class GetChangelog
{
    public function execute()
    {
        try {
            $response = (new Client())
                ->request('GET', "https://raw.githubusercontent.com/herpaderpaldent/seat-discourse/master/CHANGELOG.md");
            if ($response->getStatusCode() != 200) {
                return 'Error while fetching changelog';
            }
            $parser = new Parsedown();
            return $parser->parse($response->getBody());
        } catch (RequestException $e) {
            return 'Error while fetching changelog';
        }
    }

}