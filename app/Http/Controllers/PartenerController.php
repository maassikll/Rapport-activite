<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Partener;
use Illuminate\Http\Request;

class PartenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Parteners/Index',[
            'parteners' => Partener::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Parteners/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Partener($request->all());
        $client->save();
        return redirect()->route('parteners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partener $partener)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partener $partener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partener $partener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partener $partener)
    {
        //
    }
}
