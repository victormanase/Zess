<?php

use App\Http\Controllers\Api\DoctorApiController;
use App\Http\Controllers\PatientApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix"=>"doctors"],function(){
    Route::get("/", [DoctorApiController::class, 'index']);
});

Route::group(["prefix"=>"patients"],function(){
    Route::get("/", [PatientApiController::class, 'index']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
