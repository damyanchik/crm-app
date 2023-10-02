<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    //Logout
    Route::post('/logout', [UserController::class, 'logout']);

    //Search user
    Route::get('/ajax/search-users', [AjaxController::class, 'searchUsers'])->name('ajax.searchUsers');

    //Dashboard
    Route::get('/', [DashboardController::class, 'index']);


    //Show Orders List
    Route::get('/orders', [OrdersController::class, 'index']);


    //Create Client
    Route::get('/clients/create', [ClientsController::class, 'create']);

    //Show Client List
    Route::get('/clients', [ClientsController::class, 'index']);

    //Show Single Client
    Route::get('/clients/{client}', [ClientsController::class, 'show']);

    //Show client for edit
    Route::get('/clients/{client}/edit', [ClientsController::class, 'edit']);

    //Update client
    Route::put('/clients/{client}', [ClientsController::class, 'update']);

    //delete client
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy']);

    //create client
    Route::post('/clients', [ClientsController::class, 'store']);


    //Show Employees List
    Route::get('/employees', [EmployeesController::class, 'index']);

    //Show Single Employee
    Route::get('/employees/{user}', [EmployeesController::class, 'show']);

    //Show employee for edit
    Route::get('/employees/{user}/edit', [EmployeesController::class, 'edit']);

    //Update employee
    Route::put('/employees/{user}', [EmployeesController::class, 'update']);

    //Block employee
    Route::post('/employees/{user}/block', [EmployeesController::class, 'block']);

});

Route::middleware(['guest'])->group(function () {
    //Show Login Form
    Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

    //Show Login Form
    Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
});
