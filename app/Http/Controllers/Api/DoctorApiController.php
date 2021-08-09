<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorApiController extends Controller
{
    public function index()
    {
        return DoctorResource::collection(Doctor::all());
    }

    public function consultations($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $consultations = $doctor->consultations;
        return ConsultationResource::collection($consultations);
    }
}
