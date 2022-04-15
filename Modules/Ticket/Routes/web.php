<?php


use Illuminate\Support\Facades\Route;

Route::prefix('ticket')->group(function () {
    Route::get('/', function () {
        return "welcome";
    });
});
