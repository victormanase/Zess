<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorApiController extends Controller
{
    public function index()
    {
        return res(
            DoctorResource::collection(Doctor::all())
        );
    }

    public function consultations($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $consultations = $doctor->consultations;
        return res(ConsultationResource::collection($consultations));
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        return res(new DoctorResource($doctor));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
        ]);

        $doctor = null;
        DB::transaction(function () use ($request, &$doctor) {
            $user = User::create($request->all());
            $user->attachRole(Role::name("doctor"));
            Doctor::create($request->merge([
                "user_id" => $user->id
            ])->all());
        });

        return res(new DoctorResource($doctor), $doctor == null);
    }
}
