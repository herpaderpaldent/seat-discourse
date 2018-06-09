<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 13:13
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Get
{
    public function execute()
    {
        $client = new Client();
        try {
            $response = $client->request('GET', getenv('DISCOURSE_URL').'/groups/search.json', [
                'query' => [
                    'api_key' => getenv('DISCOURSE_API_KEY'),
                    'api_username' => getenv('DISCOURSE_API_USERNAME')
                    ],
            ]);
            $body = collect(json_decode($response->getBody()))->reject(function ($item){
                return $item->automatic;
            });

            return $body;
        } catch (GuzzleException $e) {
            return $e;
        }

    }

}