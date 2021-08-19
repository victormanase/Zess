<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function create(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:users,email",
            "patient_type_id" => "required|exists:patient_types,id",
            "client_id" => "required|exists:clients,id"
        ]);

        $patient = null;
        DB::transaction(function () use ($request, &$patient) {
            $user = User::create($request->merge([
                "password"=>"password"
            ])->all());
            $patient = Patient::create($request->merge([
                "user_id" => $user->id,
                "reference_no"=> $request->policy_no
            ])->all());
            $user->attachRole(Role::name("patient"));
        });

        if ($patient) {
            return res(new PatientResource($patient));
        }
        return res(null, false, "Something went wrong");    
    }
}
