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
        return new ConsultationResource($consultation);
    }
}
