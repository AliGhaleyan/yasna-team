<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Modules\User\Utils\Roles;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var User $support
         * @var User $supervisor
         * @var User $userManager
         * @var User $admin
         */

        User::factory(10)->create();

        $support = User::query()->create([
            "name"     => "support",
            "email"    => "support@example.com",
            "password" => bcrypt(12345678),
        ]);
        $support->assignRole(Roles::SUPPORT);

        $supervisor = User::query()->create([
            "name"     => "supervisor",
            "email"    => "supervisor@example.com",
            "password" => bcrypt(12345678),
        ]);
        $supervisor->assignRole(Roles::SUPERVISOR);

        $userManager = User::query()->create([
            "name"     => "user-manager",
            "email"    => "user-manager@example.com",
            "password" => bcrypt(12345678),
        ]);
        $userManager->assignRole(Roles::USER_MANAGER);

        $admin = User::query()->create([
            "name"     => "admin",
            "email"    => "admin@example.com",
            "password" => bcrypt(12345678),
        ]);
        $admin->assignRole(Roles::SUPPORT, Roles::SUPERVISOR, Roles::USER_MANAGER);
    }
}
