<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use App\Models\Report;
use App\Models\Partener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
        $user = Auth::user();
        $pdfFile = $request->file('pdf_data');
        $pdfData = file_get_contents($pdfFile);
        $report = new Report([
            'user_id' => $user->id,
            'pdf_data' => $pdfData,
        ]);
        $report->pdf_data = $pdfData;
        $report->save();
        
        return redirect()->route('report.index');
    }

    public function show($id){
        
        $user = Auth::user();
        $report = $user->reports()->findOrFail($id);
        $pdfData = base64_encode($report->pdf_data);
    
        
        return Inertia::render('Report/Show', compact('pdfData'));
    }

    public function indexPdf(){
        $user = Auth::user();
        $reports = $user->reports()->get();
        $reportIds = $user->reports()->pluck('id')->toArray();
        $pdfData=[];
        foreach($reports as $report){
            $pdfData[] = base64_encode($report->pdf_data); 
        }
        return Inertia::render('Report/indexPdf', [
            'pdfData' => $pdfData,
            'reportIds' => $reportIds,
        ]);
    }
}
