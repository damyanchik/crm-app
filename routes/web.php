<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ChatController;
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
    Route::post('/logout', [AuthController::class, 'logout']);

    //Search user
    Route::get('/ajax/search-users', [AjaxController::class, 'searchUsers'])->name('ajax.searchUsers');
    //Search client
    Route::get('/ajax/search-clients', [AjaxController::class, 'searchClients'])->name('ajax.searchClients');
    //Search brand
    Route::get('/ajax/search-brands', [AjaxController::class, 'searchBrands'])->name('ajax.searchBrands');
    //Search product category
    Route::get('/ajax/search-product-categories', [AjaxController::class, 'searchProductCategories'])->name('ajax.searchProductCategories');
    //search products
    Route::get('/ajax/search-products', [AjaxController::class, 'searchProducts'])->name('ajax.searchProducts');


    //Dashboard
    Route::get('/', [DashboardController::class, 'index']);


    //Chat
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/chat/ajax/load-messages', [ChatController::class, 'loadMessages'])->name('ajax.loadMessages');
    Route::post('/chat/broadcast', [PusherController::class, 'broadcast']);
    Route::post('/chat/receive', [PusherController::class, 'receive']);


    //Product list
    Route::get('/products', [ProductsController::class, 'index']);
    //Create
    Route::get('/products/create', [ProductsController::class, 'create']);
    //Store
    Route::post('/products', [ProductsController::class, 'store']);
    //Edit
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit']);
    //Update
    Route::put('/products/{product}', [ProductsController::class, 'update']);
    //Delete
    Route::delete('/products/{product}', [ProductsController::class, 'destroy']);

    //Brand List
    Route::get('/brands', [BrandsController::class, 'index']);
    //Create
    Route::get('/brands/create', [BrandsController::class, 'create']);
    //Store
    Route::post('/brands', [BrandsController::class, 'store']);
    //Edit
    Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit']);
    //Update
    Route::put('/brands/{brand}', [BrandsController::class, 'update']);
    //Delete
    Route::delete('/brands/{brand}', [BrandsController::class, 'destroy']);

    //Product Categories List
    Route::get('/product-categories', [ProductCategoriesController::class, 'index']);
    //Create
    Route::get('/product-categories/create', [ProductCategoriesController::class, 'create']);
    //Store
    Route::post('/product-categories', [ProductCategoriesController::class, 'store']);
    //Edit
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoriesController::class, 'edit']);
    //Update
    Route::put('/product-categories/{productCategory}', [ProductCategoriesController::class, 'update']);
    //Delete
    Route::delete('/product-categories/{productCategory}', [ProductCategoriesController::class, 'destroy']);


    //Order List
    Route::get('/orders', [OrdersController::class, 'index']);
    //Create
    Route::get('/orders/create', [OrdersController::class, 'create']);
    //Store
    Route::post('/orders', [OrdersController::class, 'store']);
    //Show Single
    Route::get('/orders/{order}', [OrdersController::class, 'show']);


    //Client List
    Route::get('/clients', [ClientsController::class, 'index']);
    //Create
    Route::get('/clients/create', [ClientsController::class, 'create']);
    //Show Single Client
    Route::get('/clients/{client}', [ClientsController::class, 'show']);
    //Edit
    Route::get('/clients/{client}/edit', [ClientsController::class, 'edit']);
    //Update client
    Route::put('/clients/{client}', [ClientsController::class, 'update']);
    //delete client
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy']);
    //store client
    Route::post('/clients', [ClientsController::class, 'store']);


    //Employees List
    Route::get('/employees', [EmployeesController::class, 'index']);
    //Show
    Route::get('/employees/{user}', [EmployeesController::class, 'show']);
    //Edit
    Route::get('/employees/{user}/edit', [EmployeesController::class, 'edit']);
    //Update
    Route::put('/employees/{user}', [EmployeesController::class, 'update']);
    //Block
    Route::post('/employees/{user}/block', [EmployeesController::class, 'block']);
    //Change password
    Route::put('/employees/{user}/change-pass', [EmployeesController::class, 'changePassword']);
    //delete avatar
    Route::put('/employees/{user}/delete-avatar', [EmployeesController::class, 'deleteAvatar']);

});

Route::middleware(['guest'])->group(function () {
    //Show Login Form
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

    //Show Login Form
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->middleware('guest');
});
