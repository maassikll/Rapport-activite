<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        return Inertia::render('Clients/Index', [
            'clients' => Client::paginate()
        ]);
    }

    public function create(){
        return Inertia::render('Clients/Create');
    }



    public function store(Request $request)
    {
        $client = new Client($request->all());
        $client->save();
        return redirect()->route('clients.index');
        
    }

    public function edit($id){
        $client = Client::find($id);
        return Inertia::render('Clients/Edit',compact('client'));
    }
    public function update(Request $request,$id){
        $client = Client::find($id);
        $client->update($request->all());
        return redirect()->route('clients.index');

    }
    public function destroy($id){
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index');

    }

    public function show($id){
        $client = Client::find($id);
        return Inertia::render('Clients/Show',compact('client'));
    }

    public function search(Request $request){}
    
}
