<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 18:44
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Delete
{
    public function execute(int $group_id)
    {

        $client = new Client();
        try {
            $response = $client->request('DELETE', getenv('DISCOURSE_URL') . '/admin/groups/' . $group_id . '.json', [
                'form_params' => [
                    'api_key'      => getenv('DISCOURSE_API_KEY'),
                    'api_username' => getenv('DISCOURSE_API_USERNAME')
                ],
            ]);

            if (200 === $response->getStatusCode()) {

                return "success";

            }

            abort(500, "Something went wrong at deleting group");
        } catch (GuzzleException $e) {
            return $e;

        }


    }
}