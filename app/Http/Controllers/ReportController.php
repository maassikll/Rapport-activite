<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use App\Models\Report;
use App\Models\Partener;
use Illuminate\Http\Request;



class ReportController extends Controller
{
    public function index(){
        $clientNames = Client::pluck('name');
        $partenerNames = Partener::pluck('name');

        return Inertia::render('Report/ReportForm', [
            'clientNames' => $clientNames,
            'partenerNames' => $partenerNames,
            
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf_data' => 'required|file|mimes:pdf',
        ]);
        $pdfFile = $request->file('pdf_data');
        $pdfData = file_get_contents($pdfFile);
        $report = new Report();
        $report->pdf_data = $pdfData;
        $report->save();
        
        return redirect()->route('report.index');
    }

    public function show($id){
        $report = Report::findOrFail($id);
        $pdfData = base64_encode($report->pdf_data);
    
        return Inertia::render('Report/Show', compact('pdfData'));
    }
}
