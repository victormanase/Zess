<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;

class PatientConsultationController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "",
            "users.patients.consultations",
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
    public function create(Patient $patient)
    {
        $this->patient = $patient;
        return $this->cView("form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            "date" => "required",
            "service_id" => "required|exists:services,id",
            "patient_id" => "required|exists:patients,id",
            "description" => "required"
        ]);

        Consultation::create($request->merge([
            "charge" => Service::find($request->service_id)->price
        ])->all());

        return redirect()->route("users.patients.show", $patient->id)->with("success", "Consultation created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Consultation $consultation)
    {
        $this->isEditing = true;
        $this->patient = $patient;
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
    public function update(Request $request, Patient $patient, Consultation $consultation)
    {
        $request->validate([
            "date" => "required",
            "service_id" => "required|exists:services,id",
            "patient_id" => "required|exists:patients,id",
            "description" => "required"
        ]);

        $consultation->update($request->merge([
            "charge" => Service::find($request->service_id)->price
        ])->all());

        return redirect()->route("users.patients.show", $patient->id)->with("success", "Consultation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route("users.patients.show", $patient->id)->with("success", "Consultation deleted successfully");
    }
}
