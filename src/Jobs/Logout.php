<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 21.09.2018
 * Time: 23:22.
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Jobs;

use GuzzleHttp\Client;
use Herpaderpaldent\Seat\SeatDiscourse\Exceptions\MissingMainCharacterException;
use Illuminate\Support\Facades\Redis;
use Seat\Web\Models\Group;

class Logout extends SeatDiscourseJobBase
{
    /**
     * @var array
     */
    protected $tags = ['logout'];

    /**
     * @var \Seat\Web\Models\Group
     */
    private $group;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var int
     */
    private $discourse_user_id;

    /**
     * @var \Seat\Eveapi\Models\Character\CharacterInfo
     */
    private $main_character;

    /**
     * @var int
     */
    public $tries = 1;

    /**
     * Logout constructor.
     *
     * @param \Seat\Web\Models\Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
        $this->main_character = $this->group->main_character;

        if (is_null($this->main_character)) {
            logger()->warning('Group has no main character set. Attempt to make assignation based on first attached character.', [
                'group_id' => $this->group->id,
            ]);

            $this->main_character = $group->users->first()->character;
        }

        if (! is_null($this->main_character)) {
            logger()->debug('Initialising SeAT discourse logout job for ' . $this->main_character->name);

            array_push($this->tags, 'main_character_id:' . $this->main_character->character_id);
        }
    }

    /**
     * @throws MissingMainCharacterException
     */
    public function handle()
    {
        if (is_null($this->main_character))
            throw new MissingMainCharacterException($this->group);

        Redis::funnel('seat-discourse:jobs.group_logout_' . $this->group->id)->limit(1)->then(function () {

            $this->beforeStart();

            try {
                $response = $this->client->request('POST', getenv('DISCOURSE_URL') . '/admin/users/' . $this->discourse_user_id . '/log_out', [
                    'headers' => [
                        'api-key' => getenv('DISCOURSE_API_KEY'),
                        'api-username' => getenv('DISCOURSE_API_USERNAME'),
                    ],
                ]);

                logger()->debug($response->getBody());
            } catch (\Throwable $exception) {
                $this->onFail($exception);
            }
        }, function () {
            logger()->warning('A logout job is already running for ' . $this->main_character->name . '. Removing the job from the queue.');

            $this->delete();
        });
    }

    public function beforeStart()
    {
        $this->client = new Client();

        $uri = sprintf('%s/users/by-external/%d.json', getenv('DISCOURSE_URL'), $this->main_character->character_id);

        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'api-key' => getenv('DISCOURSE_API_KEY'),
                'api-username' => getenv('DISCOURSE_API_USERNAME'),
            ],
        ]);

        $json = json_decode($response->getBody());

        $this->discourse_user_id = $json->user->id;
    }

    public function onFail($exception)
    {
        report($exception);
    }
}
