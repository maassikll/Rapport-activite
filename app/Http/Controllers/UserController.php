<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    private  $fixPassword;
    

    public function __construct()
    {
        $this->fixPassword ='f$K*oKkML9><';
    }
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::paginate()
        ]);
    }


    public function create()
    {
        return Inertia::render('Users/Create');
    }

      /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:'.User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            //'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

            

        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($this->fixPassword),
            'matricule' =>$this->generateMatricule(),
        ]);

        
        $user->save();
        

        return redirect()->route('users.index');
    }

        /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Show', compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return Inertia::render('Users/Edit', compact('user'));
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('users.index');
    }


    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');

    }


    public function generateMatricule(): int
    {
        return rand(100000,900000);
    }
}
