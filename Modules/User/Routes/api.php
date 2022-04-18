<?php

use Illuminate\Support\Facades\Route;

Route::prefix("user")->group(function () {
    Route::post("/", "UserController@store");

    Route::middleware("auth:api")->group(function () {
        Route::get("/", "UserController@index")->middleware("view.users");
    });
});
