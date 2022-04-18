<?php


namespace Modules\User\Repositories;


use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Entities\User;

class UserRepository extends Repository
{
    /**
     * Find a user by email
     *
     * @param $email
     * @return User|null
     */
    public function find($email): ?User
    {
        return $this->newQuery()->where("email", $email)->first();
    }

    /**
     * Create query of User model
     *
     * @return Builder
     */
    protected function newQuery(): Builder
    {
        return User::query();
    }
}
