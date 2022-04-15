<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Database\Seeders\CommentTableSeeder;
use Modules\Ticket\Database\Seeders\TicketDatabaseSeeder;
use Modules\User\Database\Seeders\ACLTableSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new ACLTableSeeder())->run();
        (new UserDatabaseSeeder)->run();
        (new TicketDatabaseSeeder())->run();
        (new CommentTableSeeder())->run();
    }
}
