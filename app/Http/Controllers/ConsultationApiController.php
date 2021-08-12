<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationApiController extends Controller
{
    public function show($consultation_id)
    {
        $consultation = Consultation::find($consultation_id);
        return res(new ConsultationResource($consultation));
    }

    public function store(Request $request)
    {
        $request->validate([
            "service_id"=>"required|exists:services,id",
            "doctor_id"=>"required|exists:doctors,id",
            "patient_id"=>"required|exists:patients,id",
            "date"=>"required"
        ]);
        $consultation = Consultation::create($request->all());
        return res(new ConsultationResource($consultation));
    }
}
