<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorApiController extends Controller
{
    public function index()
    {
        return Doctor::all();
    }
}
