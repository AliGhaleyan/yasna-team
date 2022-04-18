<?php

namespace Modules\Ticket\Http\Controllers;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
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

    /**
     * If user has view ticket permission, will receive all tickets
     * If the user is normal, will receive his own tickets
     *
     * @return TicketCollection
     */
    public function index(): TicketCollection
    {
        /** @var User $user */
        $user = Auth::user();

        return new TicketCollection($user->hasPermission(Permissions::VIEW_TICKET) ?
            $this->repository->paginate() :
            $this->repository->getOwnedTickets($user->id));
    }

    /**
     * Create new ticket with a unique (tracking) code
     *
     * If user is authenticated, used of current user id for owner
     *
     * Otherwise the guest user should send name and email and
     * if user not found with this email in database we register he/she and using of new id.
     *
     * @param StoreTicketRequest $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
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

    /**
     * Ticket tracking by code
     * Show ticket information with it comments
     *
     * @param Ticket $ticket
     * @return ResponseFactory|Response
     */
    public function show(Ticket $ticket)
    {
        return response(TicketResource::make($ticket));
    }

    /**
     * Close ticket
     * Set `closed` field to `true`
     *
     * @param Ticket $ticket
     * @return ResponseFactory|Response
     */
    public function close(Ticket $ticket)
    {
        $ticket->update(["closed" => true]);
        return response(["message" => "Ticket closed successfully"]);
    }

    /**
     * Update selected item
     * Set new `status`
     *
     * @param Ticket $ticket
     * @param UpdateTicketRequest $request
     * @return ResponseFactory|Response
     */
    public function update(Ticket $ticket, UpdateTicketRequest $request)
    {
        $ticket->update($request->validated());
        return response(TicketResource::make($ticket));
    }
}
