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
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CompanyDetailsController;
use App\Http\Controllers\EmployeeController;

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

    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::post('/calendar', [CalendarController::class, 'store']);
    Route::delete('/calendar/{event}', [CalendarController::class, 'destroy']);

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
    //Del photo
    Route::put('/products/{product}/delete-product-photo', [ProductsController::class, 'deletePhoto']);

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


    //Offers
    Route::get('/offers', [OffersController::class, 'index']);
    //Create
    Route::get('/offers/create', [OffersController::class, 'create']);
    //Store
    Route::post('/offers', [OffersController::class, 'store']);
    //Import
    Route::post('/offers/create/import', [OffersController::class, 'import']);
    //edit single
    Route::get('/offers/{offer}/edit', [OffersController::class, 'edit']);
    //delete
    Route::delete('/offers/{offer}', [OffersController::class, 'destroy']);
    //Update offer
    Route::put('/offers/{offer}', [OffersController::class, 'update']);
    //makeOrder
    Route::put('/offers/make-order/{offer}', [OffersController::class, 'makeOrder']);

    //Archive List
    Route::get('/orders/archive', [ArchiveController::class, 'index']);

    //Order List
    Route::get('/orders', [OrdersController::class, 'index']);
    //Show Single
    Route::get('/orders/{order}', [OrdersController::class, 'show']);
    //Ready
    Route::put('/orders/{order}/ready', [OrdersController::class, 'ready']);
    //Reject
    Route::put('/orders/{order}/reject', [OrdersController::class, 'reject']);
    //Close
    Route::put('/orders/{order}/close', [OrdersController::class, 'close']);

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


    Route::get('/invoice/{order}', [InvoiceController::class, 'generateInvoice']);

    Route::get('/admin/company-details', [CompanyDetailsController::class, 'edit']);
    Route::put('/admin/company-details/update', [CompanyDetailsController::class, 'update']);

    Route::get('/admin/new-employee', [EmployeeController::class, 'create']);
    Route::post('/admin/new-employee', [EmployeeController::class, 'store']);
});

Route::middleware(['guest'])->group(function () {
    //Show Login Form
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

    //Show Login Form
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->middleware('guest');
});
