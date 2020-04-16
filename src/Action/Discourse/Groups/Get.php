<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 13:13.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Herpaderpaldent\Seat\SeatDiscourse\Exceptions\DiscourseGuzzleException;
use Illuminate\Support\Collection;

class Get
{
    /**
     * @return \Illuminate\Support\Collection
     * @throws \Herpaderpaldent\Seat\SeatDiscourse\Exceptions\DiscourseGuzzleException
     */
    public function execute() : Collection
    {
        $client = new Client();
        try {
            $response = $client->request('GET', getenv('DISCOURSE_URL') . '/groups/search.json', [
                'headers' => [
                    'api-key' => getenv('DISCOURSE_API_KEY'),
                    'api-username' => getenv('DISCOURSE_API_USERNAME'),
                ],
            ]);

            if(! $response->getCode() === 200)
                throw new Exception($response->getMessage(), $response->getCode());

            $body = collect(json_decode($response->getBody()))->reject(function ($item) {
                return $item->automatic;
            });

            return $body;
        } catch (GuzzleException $e) {

            throw new DiscourseGuzzleException($e->getMessage(), $e->getCode());
        }

    }
}
