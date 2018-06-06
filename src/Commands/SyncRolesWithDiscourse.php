<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 05.04.2018
 * Time: 19:09
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Commands;


use function foo\func;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Attach;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Detach;
use Herpaderpaldent\Seat\SeatDiscourse\Action\Discourse\Groups\Get;
use Illuminate\Console\Command;
use Seat\Web\Models\Acl\Role;

class SyncRolesWithDiscourse extends Command
{
    protected $signature = 'seat-discourse:roles:sync';
    protected $description = 'This command creates Discourse Groups according to the Roles in SeAT';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Get $get, Attach $attach, Detach $detach)
    {

        $this->info($attach->execute(Role::all(),$get->execute()));
        $this->info($detach->execute(Role::all(),$get->execute()));


    }
}