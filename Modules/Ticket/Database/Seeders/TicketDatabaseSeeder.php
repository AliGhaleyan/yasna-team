<?php

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Entities\Ticket;

class TicketDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory(20)->create();
    }
}
