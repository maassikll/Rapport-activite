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
    public function show($id)
    {
        $partener = Partener::find($id);
        return Inertia::render('Parteners/Show', compact('partener'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partener = Partener::find($id);
        return Inertia::render('Parteners/Edit',compact('partener'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        #TODO : verifier les champs
        $partener = Partener::find($id);
        $partener->update($request->all());
        return redirect()->route('parteners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $partener = Partener::find($id);
        $partener->delete();
        return redirect()->route('parteners.index');

    }
}
