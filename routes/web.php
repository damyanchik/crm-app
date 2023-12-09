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
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;
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
    Route::post('/calendar', [CalendarController::class, 'store'])->middleware(['permission:storeCalendar']);
    Route::delete('/calendar/{event}', [CalendarController::class, 'destroy'])->middleware(['permission:destroyCalendar']);

    //Product list
    Route::get('/products', [ProductsController::class, 'index']);
    //Create
    Route::get('/products/create', [ProductsController::class, 'create'])->middleware(['permission:storeProduct']);
    //Store
    Route::post('/products', [ProductsController::class, 'store'])->middleware(['permission:storeProduct']);
    //Edit
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->middleware(['permission:updateProduct']);
    //Update
    Route::put('/products/{product}', [ProductsController::class, 'update'])->middleware(['permission:updateProduct']);
    //Delete
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->middleware(['permission:destroyProduct']);
    //Del photo
    Route::put('/products/{product}/delete-product-photo', [ProductsController::class, 'deletePhoto'])->middleware(['permission:destroyProduct']);

    //Brand List
    Route::get('/brands', [BrandsController::class, 'index']);
    //Create
    Route::get('/brands/create', [BrandsController::class, 'create'])->middleware(['permission:storeBrand']);
    //Store
    Route::post('/brands', [BrandsController::class, 'store'])->middleware(['permission:storeBrand']);
    //Edit
    Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit'])->middleware(['permission:updateBrand']);
    //Update
    Route::put('/brands/{brand}', [BrandsController::class, 'update'])->middleware(['permission:updateBrand']);
    //Delete
    Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])->middleware(['permission:destroyBrand']);

    //Product Categories List
    Route::get('/product-categories', [ProductCategoriesController::class, 'index']);
    //Create
    Route::get('/product-categories/create', [ProductCategoriesController::class, 'create'])->middleware(['permission:storeProductCategory']);
    //Store
    Route::post('/product-categories', [ProductCategoriesController::class, 'store'])->middleware(['permission:storeProductCategory']);
    //Edit
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoriesController::class, 'edit'])->middleware(['permission:updateProductCategory']);
    //Update
    Route::put('/product-categories/{productCategory}', [ProductCategoriesController::class, 'update'])->middleware(['permission:updateProductCategory']);
    //Delete
    Route::delete('/product-categories/{productCategory}', [ProductCategoriesController::class, 'destroy'])->middleware(['permission:destroyProductCategory']);


    //Offers
    Route::get('/offers', [OffersController::class, 'index']);
    //Create
    Route::get('/offers/create', [OffersController::class, 'create'])->middleware(['permission:storeOffer']);
    //Store
    Route::post('/offers', [OffersController::class, 'store'])->middleware(['permission:storeOffer']);
    //Import
    Route::post('/offers/create/import', [OffersController::class, 'import'])->middleware(['permission:storeOffer']);
    //edit single
    Route::get('/offers/{offer}/edit', [OffersController::class, 'edit'])->middleware(['permission:updateOffer']);
    //delete
    Route::delete('/offers/{offer}', [OffersController::class, 'destroy'])->middleware(['permission:destroyOffer']);
    //Update offer
    Route::put('/offers/{offer}', [OffersController::class, 'update'])->middleware(['permission:updateOffer']);
    //makeOrder
    Route::put('/offers/make-order/{offer}', [OffersController::class, 'makeOrder'])->middleware(['permission:makeOrder']);

    //Archive List
    Route::get('/orders/archive', [ArchiveController::class, 'index']);

    //Order List
    Route::get('/orders', [OrdersController::class, 'index']);
    //Show Single
    Route::get('/orders/{order}', [OrdersController::class, 'show']);
    //Ready
    Route::put('/orders/{order}/ready', [OrdersController::class, 'ready'])->middleware(['permission:readyOrder']);
    //Reject
    Route::put('/orders/{order}/reject', [OrdersController::class, 'reject'])->middleware(['permission:rejectOrder']);
    //Close
    Route::put('/orders/{order}/close', [OrdersController::class, 'close'])->middleware(['permission:closeOrder']);

    //Client List
    Route::get('/clients', [ClientsController::class, 'index']);
    //Create
    Route::get('/clients/create', [ClientsController::class, 'create'])->middleware(['permission:storeClient']);
    //Show Single Client
    Route::get('/clients/{client}', [ClientsController::class, 'show']);
    //Edit
    Route::get('/clients/{client}/edit', [ClientsController::class, 'edit'])->middleware(['permission:updateClient']);
    //Update client
    Route::put('/clients/{client}', [ClientsController::class, 'update'])->middleware(['permission:updateClient']);
    //delete client
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy'])->middleware(['permission:destroyClient']);
    //store client
    Route::post('/clients', [ClientsController::class, 'store'])->middleware(['permission:storeClient']);


    //Employees List
    Route::get('/employees', [EmployeesController::class, 'index']);
    //Show
    Route::get('/employees/{user}', [EmployeesController::class, 'show']);
    //Edit
    Route::get('/employees/{user}/edit', [EmployeesController::class, 'edit'])->middleware(['permission:updateUser']);
    //Update
    Route::put('/employees/{user}', [EmployeesController::class, 'update'])->middleware(['permission:updateUser']);
    //Block
    Route::post('/employees/{user}/block', [EmployeesController::class, 'block'])->middleware(['permission:blockUser']);
    //Change role
    Route::put('/employees/{user}/change-role', [EmployeesController::class, 'changeRole'])->middleware(['permission:rolesPermissionsAdmin']);
    //Change password
    Route::put('/employees/{user}/change-pass', [EmployeesController::class, 'changePassword'])->middleware(['permission:changePasswordUser']);
    //delete avatar
    Route::put('/employees/{user}/delete-avatar', [EmployeesController::class, 'deleteAvatar'])->middleware(['permission:deleteAvatarUser']);


    Route::get('/invoice/{order}', [InvoiceController::class, 'generateInvoice'])->middleware(['permission:closeOrder|rejectOrder|readyOrder']);

    Route::get('/admin/company-details', [CompanyDetailsController::class, 'edit'])->middleware(['permission:companyDetailsAdmin']);
    Route::put('/admin/company-details/update', [CompanyDetailsController::class, 'update'])->middleware(['permission:companyDetailsAdmin']);

    Route::get('/admin/employee-manager', [EmployeeController::class, 'create'])->middleware(['permission:employeeAdmin']);
    Route::post('/admin/employee-manager', [EmployeeController::class, 'store'])->middleware(['permission:employeeAdmin']);

    Route::get('/admin/roles-permissions', [RolesController::class, 'index'])->middleware(['permission:rolesPermissionsAdmin']);
    Route::post('/admin/roles', [RolesController::class, 'storeRole'])->middleware(['permission:rolesPermissionsAdmin']);
    Route::post('/admin/permissions', [RolesController::class, 'storePermission'])->middleware(['permission:rolesPermissionsAdmin']);
    Route::delete('/admin/roles/{role}', [RolesController::class, 'destroyRole'])->middleware(['permission:rolesPermissionsAdmin']);

    Route::get('/admin/settings', [SettingsController::class, 'index'])->middleware(['permission:settingsAdmin']);
});

Route::middleware(['guest'])->group(function () {
    //Show Login Form
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

    //Show Login Form
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->middleware('guest');
});
