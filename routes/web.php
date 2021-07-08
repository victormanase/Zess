<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Manage\RoleController;
use App\Http\Controllers\Manage\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'dashboard']);

    Route::group(["prefix"=>"manage","as"=>"manage."],function(){
        Route::resources([
            "services"=>ServiceController::class,
            "roles"=>RoleController::class
        ]);
    });
});


Auth::routes([
    "register" => false,
    "reset" => false,
    "request" => false
]);
