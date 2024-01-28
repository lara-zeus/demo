<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('operations')->insert([
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 2,
                'operation' => 'TICKET',
                'action' => 'new ticket created',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 2,
                'operation' => 'REPLAY',
                'action' => 'added new replay',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 2,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to User Reply',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'REPLAY',
                'action' => 'added new replay',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to Employee Reply',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'ESCALATION',
                'action' => 'ticket deescalated',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'ESCALATION',
                'action' => 'ticket escalated',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to Hold Ticket',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to Processing',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to Employee Reply',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to User Reply',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'STATUS',
                'action' => 'ticket status changed to Referral Ticket',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'PRIORITY',
                'action' => 'ticket priority changed to height',
            ],
            [
                'ticket_id' => 1,
                'office_id' => 1,
                'user_id' => 1,
                'operation' => 'PRIORITY',
                'action' => 'ticket priority changed to low',
            ],
        ]);

    }
}
