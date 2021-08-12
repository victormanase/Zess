<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientApiController extends Controller
{
    public function index()
    {
        return res(PatientResource::collection(Patient::all()));
    }

    public function show($id)
    {
        $patient = Patient::find($id);
        return res(new PatientResource($patient));
    }
}
