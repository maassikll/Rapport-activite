<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $clientNames = Client::pluck('name');

        return Inertia::render('Report/ReportForm', [
            'clientNames' => $clientNames,
        ]);
    }
}
