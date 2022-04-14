<?php

use Illuminate\Support\Facades\Route;

Route::prefix("ticket")->group(function () {
    Route::post("/", "TicketController@store");
    Route::get("/{ticket}", "TicketController@show");

    Route::middleware("auth:api,has.permission:a")->group(function () {
        Route::post("{ticket}/comment", "CommentController@store");
    });

//    Route::middleware("auth:api,tracking.by.code")->post("{code}");
});
