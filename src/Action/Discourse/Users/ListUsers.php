<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 07.06.18
 * Time: 09:04.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ListUsers
{
// {{base_url}}/admin/users/list/active.json?api_key={{api_key}}&api_username={{api_username}}&order=topics_entered
// show_emails=true

    public function execute()
    {
        $client = new Client();
        try {
            $response = $client->request('GET', getenv('DISCOURSE_URL') . '/admin/users/list/active.json', [
                'query' => [
                    'order' => 'topics_entered',
                    'show_emails' => 'true'
                ],
                'headers' => [
                    'api-key' => getenv('DISCOURSE_API_KEY'),
                    'api-username' => getenv('DISCOURSE_API_USERNAME'),
                ],
            ]);

            return collect(json_decode($response->getBody()));
        } catch (GuzzleException $e) {
            return $e;
        }

    }
}
