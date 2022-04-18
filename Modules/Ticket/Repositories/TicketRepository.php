<?php


namespace Modules\Ticket\Repositories;

use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Modules\Ticket\Entities\Ticket;

class TicketRepository extends Repository
{
    /**
     * Find a ticket by code
     *
     * @param $code
     * @return Ticket|null
     */
    public function find($code): ?Ticket
    {
        return $this->newQuery()->where("code", $code)->first();
    }

    /**
     * Create query of Ticket model
     *
     * @return Builder
     */
    protected function newQuery(): Builder
    {
        return Ticket::query();
    }

    /**
     * Find a ticket by code
     * If not exist ticket, throw 404 exception
     *
     * @param $code
     * @return Ticket|null
     */
    public function findOrFail($code): ?Ticket
    {
        return $this->newQuery()->where("code", $code)->firstOrFail();
    }

    /**
     * Get query for no answered and expired tickets
     *
     * @return Builder
     */
    public function getExpiredTicketsQuery(): Builder
    {
        $time = time() - (config('ticket.expire_time') * 60);

        return $this->newQuery()
            ->withCount("comments")
            ->having("comments_count", 0)
            ->where("closed", 0)
            ->where("created_at", "<", Carbon::createFromTimestamp($time));
    }

    /**
     * Get user owned tickets
     * Return paginated data
     *
     * @param int $userId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getOwnedTickets(int $userId, int $perPage = 25): LengthAwarePaginator
    {
        return $this->newQuery()->where("user_id", $userId)
            ->paginate($perPage);
    }
}
