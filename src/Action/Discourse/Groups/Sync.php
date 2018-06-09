<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 09.06.2018
 * Time: 10:48
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;


use Seat\Web\Models\Acl\Role;

class Sync
{
    protected $attach;
    protected $detach;
    protected $get;

    public function __construct(Attach $attach, Detach $detach, Get $get)
    {
        $this->attach = $attach;
        $this->detach = $detach;
        $this->get = $get;
    }

    public function execute()
    {
        $roles = Role::all();
        $groups = $this->get->execute();

        $feedback = collect();


        if($roles->map(function($role) {return $role->title;})->diff($groups->map( function ($group){return $group->name;}))->isNotEmpty())
        {
            $feedback->push($this->attach->execute($roles,$groups));
        }

        if($groups->map(function($group) {return $group->name;})->diff($roles->map( function ($role){return studly_case($role->title);}))->isNotEmpty()){
            $feedback->push($this->detach->execute($roles,$groups));
        }

        return $feedback;
    }

}