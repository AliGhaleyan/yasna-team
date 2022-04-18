<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\Traits\CreateUserTrait;
use Modules\User\Transformers\UserCollection;

class UserController extends Controller
{
    use CreateUserTrait;

    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get paginated users list
     *
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return new UserCollection($this->repository->paginate());
    }

    /**
     * Register new user
     *
     * @param RegisterRequest $request
     * @return ResponseFactory|Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data["password"] = bcrypt($data["password"]);
        $this->storeUser($data);

        return response(["message" => "User registered successfully"]);
    }
}
