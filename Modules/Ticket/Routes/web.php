<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('ticket')->group(function () {
    Route::get('/', function () {
        /** @var Modules\Ticket\Repositories\TicketRepository $repo */
        $repo = app(\Modules\Ticket\Repositories\TicketRepository::class);
        dd($repo->getExpiredTickets());
        $time = time();
        $expireMinutes = env("TICKET_EXPIRE_MINUTES", 24 * 60);
        $time = $time - ($expireMinutes * 60);
        dd(\Carbon\Carbon::createFromTimestamp(time())->format("Y-m-d H:i:s"),
            \Carbon\Carbon::createFromTimestamp($time)->format("Y-m-d H:i:s"));
//        \Carbon\Carbon::now();
    });
});
