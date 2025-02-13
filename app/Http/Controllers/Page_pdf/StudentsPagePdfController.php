<?php

namespace App\Http\Controllers\Page_pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentsPagePdfController extends Controller
{
    public function show()
    {
        // Data untuk PDF
        $data = [
            'name' => 'Annisa Rachma Fisabilillah',
            'nis' => '1020125',
            'card_number' => '1235 1231 1231 1232',
        ];
    
        $pdf = Pdf::loadView('pdf1', $data)->setPaper([0, 0, 1615.75, 2561.18], 'portrait');
    
        return $pdf->stream('student_card.pdf');

        // return view("pdf1", $data);
    }
}
