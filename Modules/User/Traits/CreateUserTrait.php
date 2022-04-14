<?php


namespace Modules\User\Traits;


use Modules\User\Entities\User;

trait CreateUserTrait
{
    public function storeUser(array $data): User
    {
        return User::query()->create($data);
    }
}
