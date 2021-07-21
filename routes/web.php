<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorConsultationController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Manage\RoleController;
use App\Http\Controllers\Manage\ServiceController;
use App\Http\Controllers\PatientConsultationController;
use App\Http\Controllers\Users\ClientController;
use App\Http\Controllers\Users\DoctorController;
use App\Http\Controllers\Users\PatientController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'dashboard']);

    Route::group(['prefix' => 'consultations', 'as' => 'consultations.'], function () {
        Route::get('{consultation}/invoice', [ConsultationController::class, 'getInvoice'])->name("get-invoice");
    });

    Route::group(["prefix" => "manage", "as" => "manage."], function () {
        Route::resources([
            "services" => ServiceController::class,
            "roles" => RoleController::class,
            "expense-categories" => ExpenseCategoryController::class,
            "expenses" => ExpenseController::class
        ]);
    });

    Route::group(["prefix" => "users", "as" => "users."], function () {

        Route::resources([
            "doctors" => DoctorController::class,
            "patients" => PatientController::class,
            "clients" => ClientController::class
        ]);

        Route::prefix('patients')->as("patients.")->group(function () {
            Route::resources([
                "{patient}/consultations" => PatientConsultationController::class
            ]);
        });
        Route::prefix('doctors')->as("doctors.")->group(function () {
            Route::resources([
                "{doctor}/consultations" => DoctorConsultationController::class
            ]);
        });
    });

    Route::resources([
        "users" => UserController::class
    ]);
});


Auth::routes([
    "register" => false,
    "reset" => false,
    "request" => false
]);
