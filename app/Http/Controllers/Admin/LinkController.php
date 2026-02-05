<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class LinkController extends Controller
{
    public function index(Request $request)
    {

        $studentToken = $request->student_id;
        $zoomToken = $request->zoom_id;
        $batchToken = $request->batch_id;

        // dd($studentId, $zoomId, $batchId);
        return view('content.pages.link', compact('studentToken', 'zoomToken', 'batchToken'));
    }

    public function dompdf()
    {
        $pdf = Pdf::loadView('content.pdf.invoice');
        return $pdf->download('test.pdf');
    }

    public function browserpdf()
    {

        $html = view('content.pdf.invoice')->render();

        $pdf = Browsershot::html($html)
            ->setNodeBinary('/usr/bin/node')
            ->setNpmBinary('/usr/bin/npm')
            ->setChromePath('/usr/bin/google-chrome-stable')
            ->noSandbox()
            ->showBackground()
            ->addChromiumArguments([
                '--disable-dev-shm-usage',
                '--disable-gpu',
            ])
            ->windowSize(1920, 1080)
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->pdf();

        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice.pdf"',
        ]);
    }
}
