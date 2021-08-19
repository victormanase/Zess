<?php

use App\Http\Controllers\Api\DoctorApiController;
use App\Http\Controllers\AuthenticationApiController;
use App\Http\Controllers\ClientApiController;
use App\Http\Controllers\ConsultationApiController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\PatientApiController;
use App\Http\Controllers\PatientTypeApiController;
use App\Http\Controllers\ServiceApiController;
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

Route::group(["prefix" => "auth"], function () {
    Route::post("login", [AuthenticationApiController::class, 'login']);
});

Route::group(["middleware" => ['auth:api']], function () {
    Route::get("auth/refresh-token", [AuthenticationApiController::class, 'refreshToken']);
    Route::get("auth/user-profile", [AuthenticationApiController::class, 'userProfile']);

    Route::group(["prefix" => "clients"], function () {
        Route::get("/", [ClientApiController::class, 'index']);
    });

    Route::group(["prefix" => "doctors"], function () {
        Route::get("/", [DoctorApiController::class, 'index']);
        Route::get("{doctor_id}", [DoctorApiController::class, 'show']);
        Route::get("{doctor_id}/consultations", [DoctorApiController::class, 'consultations']);
    });

    Route::group(["prefix" => "services"], function () {
        Route::get("/", [ServiceApiController::class, 'index']);
    });

    Route::group(["prefix" => "patient-types"], function () {
        Route::get("/", [PatientTypeApiController::class, 'index']);
    });

    Route::group(["prefix" => "dashboard"], function () {
        Route::get("stats", [DashboardApiController::class, "stats"]);
        Route::get("summary", [DashboardApiController::class, "summary"]);
    });

    Route::group(["prefix" => "consultations"], function () {
        Route::post("/store", [ConsultationApiController::class, 'store']);
        Route::get("/{consultation_id}", [ConsultationApiController::class, 'show']);
    });

    Route::group(["prefix" => "patients"], function () {
        Route::get("/", [PatientApiController::class, 'index']);
        Route::get("/{patient_id}", [PatientApiController::class, 'show']);
        Route::post("/", [PatientApiController::class, 'create']);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
