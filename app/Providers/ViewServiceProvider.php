<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Doctor;
use App\Models\ExpenseCategory;
use App\Models\Patient;
use App\Models\PatientType;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            View::share('expenseCategories', ExpenseCategory::all());
            View::share('userRoles', Role::userRoles());
            View::share("systemClients", Client::all());
            View::share("patientTypes", PatientType::all());
            View::share("patients", Patient::all());
            View::share("doctors", Doctor::all());
            View::share("services", Service::all());
            View::share("genders", $this->getGenders());
        } catch (\Throwable $th) {
        }
    }

    public function getGenders()
    {
        $genders = [
            (object)[
                "name" => "male",
                "gender" => "male",
                "id" => "male"
            ],
            (object)[
                "name" => "female",
                "gender" => "female",
                "id" => "female"
            ],
            (object)[
                "name" => "other",
                "gender" => "other",
                "id" => "other"
            ]
        ];
        return $genders;
    }
}
