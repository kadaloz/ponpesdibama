<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicantPrintController extends Controller
{
    public function show($registrationNumber)
    {
        $applicant = Applicant::where('registration_number', $registrationNumber)->firstOrFail();

        $pdf = Pdf::loadView('public.applicants.pdf', compact('applicant'));

        return $pdf->download("Bukti-Pendaftaran-{$registrationNumber}.pdf");
    }
}

