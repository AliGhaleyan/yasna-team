<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Junges\ACL\Models\Permission;
use Modules\User\Entities\User;
use Modules\User\Utils\Permissions;

class ACLTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name" => Permissions::VIEW_TICKET, "guard_name" => "api"]);
        Permission::create(["name" => Permissions::CLOSE_TICKET, "guard_name" => "api"]);
        Permission::create(["name" => Permissions::NEW_TICKET_NOTIFY, "guard_name" => "api"]);
        Permission::create(["name" => Permissions::TICKET_COMMENT, "guard_name" => "api"]);
        Permission::create(["name" => Permissions::EDIT_TICKET, "guard_name" => "api"]);
        Permission::create(["name" => Permissions::VIEW_USERS, "guard_name" => "api"]);

        /**
         * @var User $support
         * @var User $supervisor
         * @var User $userManager
         * @var User $admin
         */

        $support = User::query()->create([
            "name"     => "support",
            "email"    => "support@example.com",
            "password" => bcrypt(12345678),
        ]);
        $support->assignPermission([
            Permissions::VIEW_TICKET,
            Permissions::NEW_TICKET_NOTIFY,
            Permissions::TICKET_COMMENT,
            Permissions::EDIT_TICKET
        ]);

        $supervisor = User::query()->create([
            "name"     => "supervisor",
            "email"    => "supervisor@example.com",
            "password" => bcrypt(12345678),
        ]);
        $supervisor->assignPermission([
            Permissions::VIEW_TICKET,
            Permissions::CLOSE_TICKET,
        ]);

        $userManager = User::query()->create([
            "name"     => "user-manager",
            "email"    => "user-manager@example.com",
            "password" => bcrypt(12345678),
        ]);
        $userManager->assignPermission(Permissions::VIEW_USERS);

        $admin = User::query()->create([
            "name"     => "admin",
            "email"    => "admin@example.com",
            "password" => bcrypt(12345678),
        ]);
        $admin->assignPermission(Permission::all());
    }
}
