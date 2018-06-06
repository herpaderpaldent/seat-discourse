<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 18:01
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;


use Illuminate\Support\Collection;

class Attach
{
    protected $create;

    public function __construct(Create $create)
    {
        $this->create = $create;
    }

    public function execute(Collection $roles, Collection $groups)
    {
        try{
            $rolenames = $roles->map(function($role) {return $role->title;});
            $groupnames = $groups->map( function ($group){return $group->name;});

            $rolenames->diff($groupnames)->each(function($missingroup) {
                $this->create->execute($missingroup);
            });

            return 'Created groups: '. $rolenames->diff($groupnames);

        } catch (Exception $e){
            return $e;
        }

    }

}