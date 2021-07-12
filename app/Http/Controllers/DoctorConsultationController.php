<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Service;
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

        Consultation::create($request->merge([
            "charge" => Service::find($request->service_id)->price
        ])->all());

        return redirect()->route("users.doctors.show", $doctor->id)->with("success", "Consultation created successfully");
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
