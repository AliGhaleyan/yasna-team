<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\RegisterRequest;
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

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data["password"] = bcrypt($data["password"]);
        User::query()->create($data);

        return response(["message" => "User registered successfully"]);
    }
}
