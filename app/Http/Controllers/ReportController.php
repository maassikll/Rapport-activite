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
            'pdf_data' => 'required|file|mimes:pdf', // Add appropriate validation rules
        ]);

        // Get the uploaded PDF file from the request
        $pdfFile = $request->file('pdf_data');

        // Read the contents of the PDF file
        $pdfData = file_get_contents($pdfFile);

        // Create a new Report model instance
        $report = new Report();

        // Assign the PDF data to the model attribute
        $report->pdf_data = $pdfData;

        // Save the report to the database
        $report->save();

        // Redirect back or to any other route as needed
        return redirect()->route('report.index');
    }

    public function show($id){
        $report = Report::findOrFail($id);
        $pdfData = base64_encode($report->pdf_data);
    
        return Inertia::render('Report/Show', compact('pdfData'));
    }
}
