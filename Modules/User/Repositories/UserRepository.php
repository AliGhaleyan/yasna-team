<?php


namespace Modules\User\Repositories;


use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Entities\User;

class UserRepository extends Repository
{
    public function find($email): ?User
    {
        return $this->getQuery()->where("email", $email)->first();
    }

    protected function getQuery(): Builder
    {
        return User::query();
    }
}
