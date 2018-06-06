<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 16:01
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Create
{
    public function execute(String $groupname)
    {
        $client = new Client();
        try {
            $response = $client->request('POST', getenv('DISCOURSE_URL').'/admin/groups', [
                'form_params' => [
                    'api_key' => getenv('DISCOURSE_API_KEY'),
                    'api_username' => getenv('DISCOURSE_API_USERNAME'),
                    'group[name]' => $groupname
                ],
            ]);

            if (200 === $response->getStatusCode()) {

                return true;

            }

            abort(500,"Something went wrong at /admin/groups");
        } catch (GuzzleException $e) {
            return $e;

        }



    }

}