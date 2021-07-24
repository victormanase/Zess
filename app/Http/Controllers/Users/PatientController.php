<?php

namespace App\Http\Controllers\Users;

use App\DataTables\PatientConsultationDataTable;
use App\DataTables\PatientDataTable;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "manage/patients",
            "manage.patients",
            [],
            [],
            Patient::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientDataTable $patientDataTable)
    {
        $title = "Manage Patients";
        $create = route("manage.patients.create");
        return $patientDataTable->render("layout.table", compact("title", "create"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->cView("form");
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
            "password" => 'sometimes|nullable|confirmed',
            "password_confirmation" => "exclude_if:password,null|required",
            "patient_type_id"=>"required|exists:patient_types,id",
            "client_id" => "required|exists:clients,id"
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create($request->merge([
                "password"=>"password"
            ])->all());
            Patient::create($request->merge([
                "user_id" => $user->id
            ])->all());
            $user->attachRole(Role::name("patient"));
        });

        return redirect($this->root_url)->with("success", "Patient added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $patientConsultationDataTable = new PatientConsultationDataTable($patient);
        $this->patient = $patient;
        $this->title = "Show Patient";
        return $patientConsultationDataTable->render($this->view_root.".show", $this->view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->isEditing = true;
        $this->patient = Patient::find($id);
        $this->user = $this->patient->user;
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($patient->user->id)],
            "password" => 'nullable',
            "password_confirmation" => "exclude_if:password,null|required|confirmed",
            "client_id" => "required|exists:clients,id"
        ]);

        $patient->update($request->all());
        $patient->user->update($request->all());
        return redirect($this->root_url)->with("success", "Patient modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        DB::transaction(function () use ($patient) {
            $patient->user->delete();
            $patient->delete();
        });
        return redirect($this->root_url)->with("success", "Patient deleted successfully");
    }
}
