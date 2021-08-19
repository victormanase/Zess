<?php

namespace App\Providers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientTypeResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
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
        DoctorResource::withoutWrapping();
        PatientResource::withoutWrapping();
        ConsultationResource::withoutWrapping();
        ClientResource::withoutWrapping();
        ServiceResource::withoutWrapping();
        UserResource::withoutWrapping();
        PatientTypeResource::withoutWrapping();
    }
}
