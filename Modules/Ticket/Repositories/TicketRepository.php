<?php


namespace Modules\Ticket\Repositories;


use Modules\Ticket\Entities\Ticket;

class TicketRepository
{
    public function findByCode(int $code): ?Ticket
    {
        return Ticket::query()->where("code", $code)->first();
    }
}
