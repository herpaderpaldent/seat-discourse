<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 05.04.2018
 * Time: 19:09
 */

namespace Herpaderpaldent\Seat\SeatDiscourse\Commands;


use Illuminate\Console\Command;

class SyncRolesWithDiscourse extends Command
{
    protected $signature = 'seat-groups:users:update';
    protected $description = 'This command creates Discourse Groups according to the Roles in SeAT';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

    }
}