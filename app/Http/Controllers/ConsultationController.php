<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct() {
        $this->initialise(
            "consultations",
            "consultations",
            [],
            [],
            Consultation::class
        );
    }

    public function getInvoice(Consultation $consultation)
    {
        $pdf = pdf()->loadView("pdfs.invoice",compact("consultation"));
        return $pdf->download();
    }
}
