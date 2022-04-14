<?php

use Illuminate\Support\Facades\Route;

Route::prefix("ticket")->group(function () {
    Route::post("/", "TicketController@store");

    Route::middleware("tracking.by.code")->group(function () {
        Route::get("/tracking/{code}", "TicketController@tracking");
    });
});
