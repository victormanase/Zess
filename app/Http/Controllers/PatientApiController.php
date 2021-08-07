<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientApiController extends Controller
{
    public function index()
    {
        return PatientResource::collection(Patient::all());
    }
}
