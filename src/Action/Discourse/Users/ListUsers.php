<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 07.06.18
 * Time: 09:04
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class ListUsers
{
// {{base_url}}/admin/users/list/active.json?api_key={{api_key}}&api_username={{api_username}}&order=topics_entered
// show_emails=true

    public function execute()
    {
        $client = new Client();
        try {
            $response = $client->request('GET', getenv('DISCOURSE_URL').'/admin/users/list/active.json', [
                'query' => [
                    'api_key' => getenv('DISCOURSE_API_KEY'),
                    'api_username' => getenv('DISCOURSE_API_USERNAME'),
                    'order' => 'topics_entered',
                    'show_emails' => 'true'
                ],
            ]);

            return collect(json_decode($response->getBody()));
        } catch (GuzzleException $e) {
            return $e;
        }

    }
}