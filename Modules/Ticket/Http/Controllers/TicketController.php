<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\StoreTicketRequest;
use Modules\Ticket\Http\Requests\UpdateTicketRequest;
use Modules\Ticket\Notifications\NewTicket;
use Modules\Ticket\Repositories\TicketRepository;
use Modules\Ticket\Transformers\TicketCollection;
use Modules\Ticket\Transformers\TicketResource;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Traits\CreateUserTrait;
use Modules\User\Utils\Permissions;
use Modules\User\Utils\Roles;

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

    public function index(): TicketCollection
    {
        /** @var User $user */
        $user = Auth::user();

        return new TicketCollection($user->hasPermission(Permissions::VIEW_TICKET) ?
            $this->repository->paginate() :
            $this->repository->getOwnedTickets($user->id));
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
        /** @var Ticket $ticket */
        $ticket = Ticket::query()->create($data);

        Notification::send(User::role(Roles::SUPPORT)->get(), new NewTicket($ticket));

        return response(TicketResource::make($ticket));
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

    public function update(Ticket $ticket, UpdateTicketRequest $request)
    {
        $ticket->update($request->validated());
        return response(TicketResource::make($ticket));
    }
}
