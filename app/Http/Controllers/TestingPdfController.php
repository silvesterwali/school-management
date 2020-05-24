<?php

namespace App\Http\Controllers;

use PDF;

class TestingPdfController extends Controller
{
    public function index()
    {

        $pdf = PDF::loadView('pdf.tiket')
            ->setPaper('A4', 'landscape')
            ->setWarnings(false);
        return $pdf->download(date('Y-m-dH:i:sa') . 'invoice.pdf');
    }
}
