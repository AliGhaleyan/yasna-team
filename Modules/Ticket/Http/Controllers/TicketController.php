<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\StoreTicketRequest;
use Modules\Ticket\Repositories\TicketRepository;
use Modules\Ticket\Transformers\TicketResource;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Traits\CreateUserTrait;

class TicketController extends Controller
{
    use CreateUserTrait;

    protected TicketRepository $repository;
    protected UserRepository $userRepository;

    public function __construct(TicketRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data["code"] = Ticket::generateCode($this->repository);

        /** @var User $user */
        $user = Auth::guard("api")->user();
        if (!$user) {
            $user = $this->userRepository->find($request->email);
            if (!$user) $user = $this->storeUser($request->only("name", "email"));
        }

        $data["user_id"] = $user->id;
        $ticket = Ticket::query()->create($data);
        return response($ticket);
    }

    public function show(Ticket $ticket)
    {
        return response(TicketResource::make($ticket));
    }

    public function close(Ticket $ticket)
    {
        $ticket->update(["closed" => true]);

        return response(["message" => "Ticket closed successfully"]);
    }
}
