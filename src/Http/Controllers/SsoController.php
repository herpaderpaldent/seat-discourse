<?php

namespace Herpaderpaldent\Seat\SeatDiscourse\Http\Controllers;

use Cviebrock\DiscoursePHP\SSOHelper;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Sync;
use Illuminate\Contracts\Auth\Authenticatable as User;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Seat\Web\Models\Acl\Role;

/**
 * Class SsoController
 *
 * Controller to process the Discourse SSO request.  There is a good bit of logic in here that almost feels like too
 * much for a controller, but given that this is the only thing that this controller is doing, I am not going to break
 * it out into some service class.
 *
 * @package Spinen\Discourse
 */
class SsoController extends Controller
{
    /**
     * Package configuration
     *
     * @var Collection
     */
    protected $config;

    /**
     * SSOHelper Instance
     *
     * @var SSOHelper
     */
    protected $sso;

    /**
     * Authenticated user
     *
     * @var User
     */
    protected $user;

    /**
     * SsoController constructor.
     *
     * @param Config $config
     * @param SSOHelper $sso
     */
    /*public function __construct(Config $config, SSOHelper $sso)
    {
        $this->loadConfigs($config);

        $this->sso = $sso->setSecret($this->config->get('secret'));
    }*/
    public function __construct(SSOHelper $sso)
    {
        $this->sso = $sso->setSecret(getenv('DISCOURSE_SECRET'));
    }

    public function redirect()
    {
        if(!$this->user->group->email){
            return redirect()->route('profile.view')->with('error','You must enter an email address to use the forum.');
        }
        return redirect()->away(env('DISCOURSE_URL'));
    }


    /**
     * Build out the extra parameters to send to Discourse
     *
     * @return array
     */
    protected function buildExtraParameters()
    {
        /*return $this->config->get('user')
                            ->except(['access', 'email', 'external_id'])
                            ->reject([$this, 'nullProperty'])
                            ->map([$this, 'parseUserValue'])
                            ->map([$this, 'castBooleansToString'])
                            ->toArray();
        */
        return [

            // Groups to make sure that the user is part of in a comma-separated string
            // NOTE: Groups cannot have spaces in their names & must already exist in Discourse
            'add_groups' => $this->user->group->roles->map(function ($role){return studly_case($role->title);})->implode(', '),

            // Boolean for user a Discourse admin, leave null to ignore
            //'admin' => null,

            // Full path to user's avatar image
            'avatar_url' => 'http://image.eveonline.com/Character/'.$this->user->group->main_character_id.'_128.jpg',

            // The avatar is cached, so this triggers an update
            'avatar_force_update' => true,

            // Content of the user's bio
            //'bio' => null,

            // Boolean for user a Discourse admin, leave null to ignore
            //'moderator' => null,

            // Full name on Discourse if the user is new or
            // if SiteSetting.sso_overrides_name is set
            'name' => $this->user->group->main_character->name,

            // Groups to make sure that the user is *NOT* part of in a comma-separated string
            // NOTE: Groups cannot have spaces in their names & must already exist in Discourse
            // There is not a way to specify the exact list of groups that a user is in, so
            // you may want to send the inverse of the 'add_groups'
            'remove_groups' => Role::all()->diff($this->user->group->roles)->map(function ($role){return studly_case($role->title);})->implode(', '),

            // If the email has not been verified, set this to true
            'require_activation' => false,

            // username on Discourse if the user is new or
            // if SiteSetting.sso_overrides_username is set
            'username' => $this->user->name,
        ];
    }

    /**
     * Make boolean's into string
     *
     * The Discourse SSO API does not accept 0 or 1 for false or true.  You must send
     * "false" or "true", so convert any boolean property to the string version.
     *
     * @param $property
     *
     * @return string
     */
    public function castBooleansToString($property)
    {
        if (! is_bool($property)) {
            return $property;
        }

        return ($property) ? 'true' : 'false';
    }

    /**
     * Cache the configs on the object as a collection
     *
     * The 'user' property will be an array, so go ahead and convert it to a collection
     *
     * @param Config $config
     */
    /*protected function loadConfigs(Config $config)
    {
        $this->config = collect($config->get('services.discourse'));
        $this->config->put('user', collect($this->config->get('user')));
    }*/

    /**
     * Process the SSO login request from Discourse
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function login(Request $request, Sync $sync)
    {
        if(!$this->user->group->email){
            return redirect()->route('profile.view')->with('error','You must enter an email address to use the forum.');
        }
        //ToDo: Refactoring sync by replacing it with model events
        $sync->execute();

        $this->user = $request->user();



        if (! ($this->sso->validatePayload($payload = $request->get('sso'), $request->get('sig')))) {
            abort(403); //Forbidden
        }

        $query = $this->sso->getSignInString(
            $this->sso->getNonce($payload),
            $this->user->group->main_character_id,
            $this->user->group->email,
            $this->buildExtraParameters()
        );

        return redirect(str_finish(getenv('DISCOURSE_URL'), '/').'session/sso_login?'.$query);
    }

    /**
     * Check to see if property is null
     *
     * @param string $property
     * @return bool
     */
    public function nullProperty($property)
    {
        return is_null($property);
    }

    /**
     * Get the property from the user
     *
     * If a string is passed in, then get it from the user object, otherwise, return what was given
     *
     * @param string $property
     * @return mixed
     */
    public function parseUserValue($property)
    {
        if (! is_string($property)) {
            return $property;
        }

        return $this->user->{$property};
    }
}
