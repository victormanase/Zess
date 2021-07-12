<?php

namespace App\Http\Controllers\Users;

use App\DataTables\DoctorConsultationDataTable;
use App\DataTables\DoctorDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "users/doctors",
            "users.doctors",
            [],
            [],
            Doctor::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorDataTable $doctorDataTable)
    {
        $title = "Manage Doctors";
        $create = route("users.doctors.create");
        return $doctorDataTable->render("layout.table", compact("title", "create"));
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
            "password" => "required|confirmed",
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create($request->all());
            $user->attachRole(Role::name("doctor"));
            Doctor::create($request->merge([
                "user_id" => $user->id
            ])->all());
        });
        return redirect($this->root_url)->with("success", "Doctor created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        $this->doctor = $doctor;
        $doctorConsultationDatatable = new DoctorConsultationDataTable($doctor);
        $this->title = "Show Doctor";
        return $doctorConsultationDatatable->render($this->view_root.".show", $this->view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $this->isEditing = true;
        $this->doctor = $doctor;
        $this->user = $doctor->user;
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($doctor->user->id)],
            "password" => 'nullable',
            "password_confirmation" => "exclude_if:password,null|required|confirmed"
        ]);

        $doctor->update($request->all());
        $doctor->user->update($request->all());
        return redirect($this->root_url)->with("success", "Doctor modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        DB::transaction(function () use ($doctor) {
            $doctor->user->delete();
            $doctor->delete();
        });
        return redirect($this->root_url)->with("success", "Doctor deleted successfully");
    }
}
