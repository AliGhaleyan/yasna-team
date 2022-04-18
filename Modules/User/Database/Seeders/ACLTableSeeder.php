<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Utils\Permissions;
use Modules\User\Utils\Roles;

class ACLTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var Role $support
         * @var Role $supervisor
         * @var Role $userManager
         */
        $supervisor = Role::query()->create(["name" => Roles::SUPERVISOR]);
        $support = Role::query()->create(["name" => Roles::SUPPORT]);
        $userManager = Role::query()->create(["name" => Roles::USER_MANAGER]);

        Permission::query()->create(["name" => Permissions::VIEW_TICKET]);
        Permission::query()->create(["name" => Permissions::CLOSE_TICKET]);
        Permission::query()->create(["name" => Permissions::NEW_TICKET_NOTIFY]);
        Permission::query()->create(["name" => Permissions::TICKET_COMMENT]);
        Permission::query()->create(["name" => Permissions::EDIT_TICKET]);
        Permission::query()->create(["name" => Permissions::VIEW_USERS]);

        $supervisor->assignPermission(Permissions::VIEW_TICKET, Permissions::CLOSE_TICKET);
        $support->assignPermission(Permissions::VIEW_TICKET, Permissions::NEW_TICKET_NOTIFY, Permissions::TICKET_COMMENT, Permissions::EDIT_TICKET);
        $userManager->assignPermission(Permissions::VIEW_USERS);
    }
}
