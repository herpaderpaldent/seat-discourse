<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 16:01.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Herpaderpaldent\Seat\SeatDiscourse\Exceptions\DiscourseGuzzleException;

class Create
{
    /**
     * @param string $groupname
     *
     * @return string
     * @throws \Herpaderpaldent\Seat\SeatDiscourse\Exceptions\DiscourseGuzzleException
     */
    public function execute(String $groupname): string
    {
        $client = new Client();
        try {
            $response = $client->request('POST', getenv('DISCOURSE_URL') . '/admin/groups', [
                'form_params' => [
                    'group[name]' => $groupnam
                ],
                'headers' => [
                    'api-key' => getenv('DISCOURSE_API_KEY'),
                    'api-username' => getenv('DISCOURSE_API_USERNAME')
                ],
            ]);,

            if (200 === $response->getStatusCode()) {

                return 'Created Group: ' . $groupname;

            }

            abort(500, 'Something went wrong at /admin/groups');
        } catch (GuzzleException $e) {

            throw new DiscourseGuzzleException($e->getMessage(), $e->getCode());
        }

    }
}
