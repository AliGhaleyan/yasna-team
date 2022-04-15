<?php

namespace Modules\Ticket\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Ticket\Repositories\TicketRepository;

class CheckExpiredTickets
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected TicketRepository $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TicketRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tickets = $this->repository->getExpiredTickets();
        $tickets->toQuery()->delete();
    }
}
