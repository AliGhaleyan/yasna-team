<?php


namespace Modules\Ticket\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Entities\Ticket;

class TicketRepository extends Repository
{
    public function find($code): ?Ticket
    {
        return $this->getQuery()->where("code", $code)->first();
    }

    public function findOrFail($code): ?Ticket
    {
        return $this->getQuery()->where("code", $code)->firstOrFail();
    }

    protected function getQuery(): Builder
    {
        return Ticket::query();
    }
}
