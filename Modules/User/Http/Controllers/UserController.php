<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\UserCollection;

class UserController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): UserCollection
    {
        return new UserCollection($this->repository->paginate());
    }
}
