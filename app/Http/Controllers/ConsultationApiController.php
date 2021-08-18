<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            "patient_id"=>"required|exists:patients,id",
            "date"=>"required"
        ]);

        $data = $request->all();
        if($request->user()->hasRole("doctor")){
            $data["doctor_id"] = $request->user()->doctor->id;
        }else if($request->user()->hasRole("administrator")){
            if(!$request->has("doctor_id"))
                return res([], false, "Doctor Id field is required!");
            $data["doctor_id"] = $request->doctor_id;
        }

        $consultation = Consultation::create($data);
        return res(new ConsultationResource($consultation));
    }
}
