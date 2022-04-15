<?php

use Illuminate\Support\Facades\Route;

Route::middleware("auth:api")->prefix("user")->group(function () {
    Route::get("/", "UserController@index")->middleware("view.users");
});
