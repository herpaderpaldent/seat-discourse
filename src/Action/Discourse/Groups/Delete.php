<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 18:44.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Herpaderpaldent\Seat\SeatDiscourse\Exceptions\DiscourseGuzzleException;

class Delete
{
    /**
     * @param int $group_id
     *
     * @return string
     */
    public function execute(int $group_id)
    {

        $client = new Client();
        try {
            $response = $client->request('DELETE', getenv('DISCOURSE_URL') . '/admin/groups/' . $group_id . '.json', [
                'headers' => [
                    'api-key'      => getenv('DISCOURSE_API_KEY'),
                    'api-username' => getenv('DISCOURSE_API_USERNAME'),
                ],
            ]);

            if (200 === $response->getStatusCode()) {

                return 'success';

            }

            abort(500, 'Something went wrong at deleting group');
        } catch (GuzzleException $e) {

            throw new DiscourseGuzzleException($e->getMessage(), $e->getCode());
        }

    }
}
