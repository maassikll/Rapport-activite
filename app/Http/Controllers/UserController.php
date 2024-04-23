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
    private $fixPassword;
    private $matricule;
    public function __construct()
    {
        $this->matricule = rand(100000,900000);
        $this->fixPassword = 'f$K*oKkML9><';
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
            
        ]);

            

        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($this->fixPassword),
            'matricule' =>$this->matricule,
        ]);

        
        $user->save();
        

        return redirect()->route('users.index');
    }
}
