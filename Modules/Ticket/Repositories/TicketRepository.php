<?php


namespace Modules\Ticket\Repositories;


use App\Repositories\RepositoryInterface;
use Modules\Ticket\Entities\Ticket;

class TicketRepository implements RepositoryInterface
{
    public function find($code): ?Ticket
    {
        return Ticket::query()->where("code", $code)->first();
    }
}
