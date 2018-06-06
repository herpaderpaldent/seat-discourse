<?php
/**
 * Created by PhpStorm.
 * User: fehu
 * Date: 05.06.18
 * Time: 18:56
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups;


use Illuminate\Support\Collection;


class Detach
{
    protected $delete;

    public function __construct(Delete $delete)
    {
        $this->delete = $delete;
    }

    public function execute(Collection $roles, Collection $groups)
    {
        try{
            $rolenames_array = $roles->map(function($role) {return $role->title;})->toArray();

            //Group minus Roles, what is left should be deleted
            $groups->each(function ($group) use ($rolenames_array) {
                if(!in_array($group->name, $rolenames_array) ){
                    $this->delete->execute($group->id);
                };
            });

            $groupnames = $groups->map( function ($group) {return $group->name;});
            $rolenames = $roles->map(function($role) {return $role->title;});

            return "Groups deleted " . $rolenames->diff($groupnames);


        } catch (Exception $e){
            return $e;
        }

    }

}