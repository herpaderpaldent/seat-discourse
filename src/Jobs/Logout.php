<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 21.09.2018
 * Time: 23:22
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Jobs;


use Seat\Web\Models\Group;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

class Logout extends SeatDiscourseJobBase
{
    /**
     * @var array
     */
    protected $tags = ['logout'];

    private $group;

    private $client;

    private $discourse_user_id;

    /**
     * @var int
     */
    public $tries = 1;

    /**
     * ConversationOrchestrator constructor.
     *
     * @param \Seat\Web\Models\Group $group
     */
    public function __construct(Group $group)
    {

        logger()->debug('Initialising SeAT discourse logout job for ' . $group->main_character->name);

        $this->group = $group;

        array_push($this->tags, 'main_character_id:' . $group->main_character_id);

        $this->client = new Client();

    }

    public function handle()
    {
        Redis::funnel('seat-discourse:jobs.group_logout_' . $this->group->main_character_id)->limit(1)->then(function ()
        {
            $this->beforeStart();

            try {
                $response = $this->client->request('POST', getenv('DISCOURSE_URL').'/admin/users/' . $this->discourse_user_id . '/log_out', [
                    'form_params' => [
                        'api_key' => getenv('DISCOURSE_API_KEY'),
                        'api_username' => getenv('DISCOURSE_API_USERNAME')
                    ],
                ]);

                logger()->debug(json_decode($response->getBody()));

                $this->onFinish();


            } catch (\Throwable $exception) {

                $this->onFail($exception);

            }

        }, function ()
        {
            logger()->warning('A logout job is already running for ' . $this->group->main_character->name . ' Removing the job from the queue.');

            $this->delete();
        });


    }

    public function beforeStart()
    {
        $response = $this->client->request('GET', getenv('DISCOURSE_URL').'/users/by-external/'. $this->group->main_character_id .'.json', [
            'query' => [
                'api_key' => getenv('DISCOURSE_API_KEY'),
                'api_username' => getenv('DISCOURSE_API_USERNAME')
            ],
        ]);

        $user = collect(json_decode($response->getBody()));

        $this->discourse_user_id = $user['user']->id;

    }

    public function onFail($exception)
    {

        report($exception);
    }

    public function onFinish()
    {

    }

}