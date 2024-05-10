<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use App\Models\Partener;



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
}
