<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\StoreTicketRequest;
use Modules\Ticket\Repositories\TicketRepository;
use Modules\User\Entities\User;

class TicketController extends Controller
{
    protected TicketRepository $repository;

    public function __construct(TicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data["code"] = Ticket::generateCode();

        /** @var User $user */
        $user = Auth::guard("api")->user();
        if (!$user) {
            $user = User::query()->where("email", $request->email)->first();
            if (!$user) $user = User::query()->create([
                "name"  => $request->name,
                "email" => $request->email,
            ]);
        }

        $data["user_id"] = $user->id;
        $ticket = Ticket::query()->create($data);
        return response($ticket);
    }

    public function tracking(int $code)
    {
        return response($this->repository->findByCode($code));
    }
}
