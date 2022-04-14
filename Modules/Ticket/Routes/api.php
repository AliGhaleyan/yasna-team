<?php

use Illuminate\Support\Facades\Route;

Route::prefix("ticket")->group(function () {
    Route::post("/", "TicketController@store");

    Route::middleware("tracking.by.code")->group(function () {
        Route::get("/{code}", "TicketController@show");

        Route::middleware("auth:api")->post("{code}/comment", "CommentController@store");
    });
});
