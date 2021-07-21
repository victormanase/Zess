<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationInvestigation;
use App\Models\ConsultationPd;
use App\Models\ConsultationPlan;
use App\Models\Doctor;
use App\Models\Service;
use App\Utils\Traits\ConsultationTrait;
use Illuminate\Http\Request;

class DoctorConsultationController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "",
            "users.doctors.consultations",
            [],
            [],
            Consultation::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Doctor $doctor)
    {
        $this->doctor = $doctor;
        return $this->cView("form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doctor $doctor)
    {
        $request->validate([
            "date" => "required",
            "service_id" => "required|exists:services,id",
            "patient_id" => "required|exists:patients,id",
            "doctor_id" => "required|exists:doctors,id",
            "description" => "required"
        ]);

        $consultation = Consultation::create($request->merge([
            "charge" => Service::find($request->service_id)->price
        ])->all());

        if ($request->has("plans")) {
            foreach ($request->plans as $key => $plan) {
                $consultation->plans()->create(["content" => $plan]);
            }
        }
        if ($request->has("pds")) {
            foreach ($request->pds as $key => $pd) {
                $consultation->pds()->create(["content" => $pd]);
            }
        }

        if ($request->has("investigations")) {
            foreach ($request->investigations as $key => $investigation) {
                $consultation->investigations()->create(["content" => $investigation]);
            }
        }

        return redirect()->route("users.doctors.show", $doctor->id)->with("success", "Consultation created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor, Consultation $consultation)
    {
        $this->consultation = $consultation;
        $this->title = "Viewing Consultation";
        return view("components.show-consultation", $this->view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor, Consultation $consultation)
    {
        $this->isEditing = true;
        $this->doctor = $doctor;
        $this->consultation = $consultation;
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor, Consultation $consultation)
    {
        $request->validate([
            "date" => "required",
            "service_id" => "required|exists:services,id",
            "patient_id" => "required|exists:patients,id",
            "doctor_id" => "required|exists:doctors,id",
            "description" => "required"
        ]);

        $consultation->update($request->merge([
            "charge" => Service::find($request->service_id)->price
        ])->all());

        if ($request->has("plans")) {
            $consultation->plans()->delete();
            foreach ($request->plans as $key => $plan) {
                $consultation->plans()->create(["content" => $plan]);
            }
        }

        if ($request->has("pds")) {
            $consultation->plans()->delete();
            foreach ($request->pds as $key => $pd) {
                $consultation->pds()->create(["content" => $pd]);
            }
        }

        if ($request->has("investigations")) {
            $consultation->plans()->delete();
            foreach ($request->investigations as $key => $investigation) {
                $consultation->investigations()->create(["content" => $investigation]);
            }
        }

        return redirect()->route("users.doctors.show", $doctor->id)->with("success", "Consultation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor, Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route("users.doctors.show", $doctor->id)->with("success", "Consultation deleted successfully");
    }
}
