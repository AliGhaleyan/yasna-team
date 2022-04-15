<?php


namespace Modules\Ticket\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

    public function getExpiredTickets()
    {
        $time = time();
        $expireMinutes = env("TICKET_EXPIRE_MINUTES", 24 * 60);
        $time = $time - ($expireMinutes * 60);
        return $this->getQuery()
            ->withCount("comments")
            ->having("comments_count", 0)
            ->where("created_at", "<", Carbon::createFromTimestamp($time))
            ->get();
    }

    protected function getQuery(): Builder
    {
        return Ticket::query();
    }
}
