<?php


namespace Modules\User\Repositories;


use App\Repositories\RepositoryInterface;
use Modules\User\Entities\User;

class UserRepository implements RepositoryInterface
{
    public function find($email): ?User
    {
        return User::query()->where("email", $email)->first();
    }
}
