<?php

use Illuminate\Support\Facades\Route;

Route::prefix("ticket")->group(function () {
    Route::post("/", "TicketController@store");
    Route::get("/{ticket}", "TicketController@show");

    Route::middleware("auth:api")->group(function () {
        Route::post("{ticket}/comment", "CommentController@store")->middleware("ticket.comment");
        Route::post("{ticket}/close", "TicketController@close")->middleware("close.ticket");
    });
});
