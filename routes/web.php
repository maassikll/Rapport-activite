<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PartenerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create',[UserController::class, 'create'])->name('users.create');
    Route::post('users',[UserController::class,'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('users/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/report', [UserController::class, 'report']);


    
    
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/create',[ClientController::class, 'create'])->name('clients.create');
    Route::post('clients',[ClientController::class, 'store'])->name('clients.store');
    Route::get('clients/{client}',[ClientController::class, 'show'])->name('clients.show');
    Route::get('clients/{client}/edit',[ClientController::class,'edit'])->name('clients.edit');
    Route::put('clients/{client}',[ClientController::class,'update'])->name('clients.update');
    Route::delete('clients/{id}',[ClientController::class,'destroy'])->name('clients.destroy');


    Route::get('parteners',[PartenerController::class,'index'])->name('parteners.index');
    Route::get('parteners/create',[PartenerController::class,'create'])->name('parteners.create');
    Route::post('parteners',[PartenerController::class,'store'])->name('parteners.store');
    Route::get('parteners/{id}',[PartenerController::class,'show'])->name('parteners.show');
    Route::get('parteners/{partener}/edit',[PartenerController::class,'edit'])->name('parteners.edit');
    Route::put('partener/{partener}',[PartenerController::class,'update'])->name('parteners.update');
    Route::delete('parteners/{id}', [PartenerController::class, 'destroy'])->name('parteners.destroy');


    Route::get('report',[ReportController::class,'index'])->name('report.index');
    Route::post('report',[ReportController::class,'store'])->name('report.store');
    Route::get('report/{id}',[ReportController::class,'show'])->name('report.show');
    


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
