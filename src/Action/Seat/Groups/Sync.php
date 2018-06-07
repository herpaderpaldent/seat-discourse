<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 07.06.18
 * Time: 15:34
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Seat\Groups;


use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Users\ListUsers;
use Seat\Web\Models\Group;

class Sync
{

    protected $list_users;

    public function __construct(ListUsers $list_users)
    {
        $this->list_users = $list_users;
    }

    public function execute(Group $group)
    {

        if($group->email)
        {

            if(! in_array($group->email,$this->list_users->execute()->map(function ($item){return $item->email;})->toArray()))
            {
                return "mail exists";
            }
            return "Discourse User already exists for Group";
            //$this->info($create->execute(Group::find(3)));
            //$this->info(studly_case(Group::find(2)->main_character->name));
        }
    }

}