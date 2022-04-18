<?php


namespace Modules\User\Traits;


use Modules\User\Entities\User;

trait CreateUserTrait
{
    /**
     * Create and return new user
     *
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        return User::query()->create($data);
    }
}
