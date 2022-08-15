<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripsController;
use App\Http\Controllers\AdressesController;
use App\Http\Middleware\UsersAutenticator;
use App\Http\Controllers\UsersController;

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

Route::get('/login', [UsersController::class, "index"])->name('login');
Route::post('/login', [UsersController::class, "validateLogin"])->name('login.validate');
Route::post('/users/store', [UsersController::class, "store"])->name('users.store');

Route::middleware(UsersAutenticator::class)->group(function(){
    Route::get('/', function () {
        return redirect()->route('trips.index'); 
    });
    
    Route::get('/logout', [UsersController::class, "logout"])->name('logout');
    Route::get('/index', [TripsController::class, "index"])->name('trips.index');

    Route::get('/adresses/create', [AdressesController::class, "create"])->name('adresses.create');
    Route::post('/adresses/store', [AdressesController::class, "store"])->name('adresses.store');
    Route::get('/adresses/show/{id}', [AdressesController::class, "show"])->name('adresses.show');
    Route::get('/adresses/edit/{id}', [AdressesController::class, "edit"])->name('adresses.edit');
    Route::post('/adresses/update', [AdressesController::class, "update"])->name('adresses.update');
    Route::post('/adresses/delete/{id}', [AdressesController::class, "destroy"])->name('adresses.destroy');
    Route::get('/adresses/json', [AdressesController::class, "showJson"])->name('adresses.json');   
    
    Route::get('/trips/create', [TripsController::class, "create"])->name('trips.create');
    Route::post('/trips/store', [TripsController::class, "store"])->name('trips.store');
    Route::get('/trips/store', [TripsController::class, "store"])->name('trips.store');
    Route::get('/trips/show/{id}', [TripsController::class, "show"])->name('trips.show');
    Route::get('/trips/edit/{id}', [TripsController::class, "edit"])->name('trips.edit');
    Route::post('/trips/update', [TripsController::class, "update"])->name('trips.update');
    Route::post('/trips/delete/{id}', [TripsController::class, "destroy"])->name('trips.destroy');
    Route::get('/trips/delete/{id}', [TripsController::class, "destroy"])->name('trips.destroy');
    Route::get('/trips/json', [TripsController::class, "showJson"])->name('trips.json'); 
    Route::get('/trips/json-example', [TripsController::class, "showExampleJson"])->name('trips.showExampleJson'); 
    Route::post('/trips/json-execute', [TripsController::class, "executeJson"])->name('trips.executeJson');  
});



