<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    public function stats()
    {
        return res([
            "total_consultations" => Consultation::count(),
            "total_patients" => Patient::count(),
            "total_doctors" => Doctor::count(),
            "total_pending_consultations" => Consultation::whereStatus("pending")->count()
        ]);
    }
}
