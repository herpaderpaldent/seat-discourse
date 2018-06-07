<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 05.04.2018
 * Time: 19:09
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Commands;

use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Attach;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Detach;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Get;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users\Create;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users\ListUsers;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Seat\Groups\Sync;
use Illuminate\Console\Command;
use Seat\Web\Models\Acl\Role;
use Seat\Web\Models\Group;

class SyncRolesWithDiscourse extends Command
{
    protected $signature = 'seat-discourse:roles:sync';
    protected $description = 'This command creates Discourse Groups according to the Roles in SeAT';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Get $get, Attach $attach, Detach $detach, Create $create, ListUsers $list_users, Sync $sync)
    {

        //return $get->execute();
        //$this->info($attach->execute(Role::all(),$get->execute()));
        //$this->info($detach->execute(Role::all(),$get->execute()));

        /*if(Group::find(3)->email)
        {
            $this->info($create->execute(Group::find(3)));
           //$this->info(studly_case(Group::find(2)->main_character->name));
        }*/

        $this->info($list_users->execute()->map(function ($item){return $item->email;}));
        $this->info($sync->execute(Group::find(2)));




    }
}