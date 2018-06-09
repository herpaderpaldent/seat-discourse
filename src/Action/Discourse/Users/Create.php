<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 06.06.18
 * Time: 16:53
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Seat\Web\Models\Group;


class Create
{
    public function execute(Group $group)
    {

        $client = new Client();
        try {
            $response = $client->request('POST', getenv('DISCOURSE_URL') . '/users.json', [
                'form_params' => [
                    'api_key'      => getenv('DISCOURSE_API_KEY'),
                    'api_username' => getenv('DISCOURSE_API_USERNAME'),
                    'name'  => $group->main_character->name,
                    'email' => $group->email,
                    'password' => md5(microtime()),
                    'username' => studly_case($group->main_character->name),
                    'active' => true,
                    'approved' => true
                ],
            ]);

            if (200 === $response->getStatusCode()) {

                return "User " . studly_case($group->main_character->name) . " successfully created." ;

            }

            abort(500, "Something went wrong at creating user");
        } catch (GuzzleException $e) {
            return $e;

        }


    }
}