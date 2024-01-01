<?php

use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CompanyDetailsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CSVImportController;
use App\Http\Controllers\ProductListController;
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
Auth::Routes(['verify' => 'true']);

Route::middleware(['auth', 'verified'])->group(function () {
    //Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Ajax Search
    Route::get('/ajax/search-users', [AjaxController::class, 'searchUsers'])->name('ajax.searchUsers');
    Route::get('/ajax/search-clients', [AjaxController::class, 'searchClients'])->name('ajax.searchClients');
    Route::get('/ajax/search-brands', [AjaxController::class, 'searchBrands'])->name('ajax.searchBrands');
    Route::get('/ajax/search-product-categories', [AjaxController::class, 'searchProductCategories'])->name('ajax.searchProductCategories');
    Route::get('/ajax/search-products', [AjaxController::class, 'searchProducts'])->name('ajax.searchProducts');

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/ajax/load-messages', [ChatController::class, 'loadMessages'])->name('ajax.loadMessages');
    Route::post('/chat/broadcast', [PusherController::class, 'broadcast']);
    Route::post('/chat/receive', [PusherController::class, 'receive']);

    //Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('/calendar', [CalendarController::class, 'store'])->middleware(['permission:storeCalendar'])->name('storeCalendar');
    Route::delete('/calendar/{event}', [CalendarController::class, 'destroy'])->middleware(['permission:destroyCalendar'])->name('destroyCalendar');

    //Product
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductsController::class, 'create'])->middleware(['permission:storeProduct'])->name('createProduct');
    Route::post('/products', [ProductsController::class, 'store'])->middleware(['permission:storeProduct'])->name('storeProduct');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->middleware(['permission:updateProduct'])->name('editProduct');
    Route::put('/products/{product}', [ProductsController::class, 'update'])->middleware(['permission:updateProduct'])->name('updateProduct');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->middleware(['permission:destroyProduct'])->name('destroyProduct');
    Route::put('/products/{product}/delete-product-photo', [ProductsController::class, 'deletePhoto'])->middleware(['permission:destroyProduct'])->name('destroyProductPhoto');

    //Brand
    Route::get('/brands', [BrandsController::class, 'index'])->name('brands');
    Route::get('/brands/create', [BrandsController::class, 'create'])->middleware(['permission:storeBrand'])->name('createBrand');
    Route::post('/brands', [BrandsController::class, 'store'])->middleware(['permission:storeBrand'])->name('storeBrand');
    Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit'])->middleware(['permission:updateBrand'])->name('editBrand');
    Route::put('/brands/{brand}', [BrandsController::class, 'update'])->middleware(['permission:updateBrand'])->name('updateBrand');
    Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])->middleware(['permission:destroyBrand'])->name('destroyBrand');

    //Product Categories
    Route::get('/product-categories', [ProductCategoriesController::class, 'index'])->name('prodCats');
    Route::get('/product-categories/create', [ProductCategoriesController::class, 'create'])->middleware(['permission:storeProductCategory'])->name('createProdCat');
    Route::post('/product-categories', [ProductCategoriesController::class, 'store'])->middleware(['permission:storeProductCategory'])->name('storeProdCat');;
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoriesController::class, 'edit'])->middleware(['permission:updateProductCategory'])->name('editProdCat');;
    Route::put('/product-categories/{productCategory}', [ProductCategoriesController::class, 'update'])->middleware(['permission:updateProductCategory'])->name('updateProdCat');;
    Route::delete('/product-categories/{productCategory}', [ProductCategoriesController::class, 'destroy'])->middleware(['permission:destroyProductCategory'])->name('destroyProdCat');;

    //Offers
    Route::get('/offers', [OffersController::class, 'index'])->name('offers');
    Route::get('/offers/create', [OffersController::class, 'create'])->middleware(['permission:storeOffer'])->name('createOffer');
    Route::post('/offers', [OffersController::class, 'store'])->middleware(['permission:storeOffer'])->name('storeOffer');
    Route::get('/offers/{offer}/edit', [OffersController::class, 'edit'])->middleware(['permission:updateOffer'])->name('editOffer');
    Route::delete('/offers/{offer}', [OffersController::class, 'destroy'])->middleware(['permission:destroyOffer'])->name('destroyOffer');
    Route::put('/offers/{offer}', [OffersController::class, 'update'])->middleware(['permission:updateOffer'])->name('updateOffer');
    Route::put('/offers/make-order/{offer}', [OffersController::class, 'makeOrder'])->middleware(['permission:makeOrder'])->name('makeOrder');

    //Import
    Route::post('/offers/create', [CSVImportController::class, 'importToOffer'])->middleware(['permission:storeOffer'])->name('importOffer');
    Route::post('/products/import-new-product', [CSVImportController::class, 'importToStoreProducts'])->middleware(['permission:storeProduct'])->name('importNewProduct');
    Route::post('/products/import-update-product', [CSVImportController::class, 'importToUpdateQuantityAndPrice'])->middleware(['permission:storeProduct'])->name('importUpdateProduct');

    //Archive
    Route::get('/orders/archive', [ArchiveController::class, 'index'])->name('orderArchives');

    //Order
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('showOrder');
    Route::put('/orders/{order}/ready', [OrdersController::class, 'ready'])->middleware(['permission:readyOrder'])->name('readyOrder');
    Route::put('/orders/{order}/reject', [OrdersController::class, 'reject'])->middleware(['permission:rejectOrder'])->name('rejectOrder');
    Route::put('/orders/{order}/close', [OrdersController::class, 'close'])->middleware(['permission:closeOrder'])->name('closeOrder');

    //Clients
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientsController::class, 'create'])->middleware(['permission:storeClient'])->name('createClient');
    Route::get('/clients/{client}', [ClientsController::class, 'show'])->name('showClient');
    Route::get('/clients/{client}/edit', [ClientsController::class, 'edit'])->middleware(['permission:updateClient'])->name('editClient');
    Route::put('/clients/{client}', [ClientsController::class, 'update'])->middleware(['permission:updateClient'])->name('updateClient');
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy'])->middleware(['permission:destroyClient'])->name('destroyClient');
    Route::post('/clients', [ClientsController::class, 'store'])->middleware(['permission:storeClient'])->name('storeClient');

    //Employees
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
    Route::get('/employees/{user}', [EmployeesController::class, 'show'])->name('showEmployee');
    Route::get('/employees/{user}/edit', [EmployeesController::class, 'edit'])->name('editEmployee');
    Route::put('/employees/{user}', [EmployeesController::class, 'update'])->name('updateEmployee');
    Route::post('/employees/{user}/block', [EmployeesController::class, 'block'])->middleware(['permission:blockUser'])->name('blockEmployee');
    Route::put('/employees/{user}/change-role', [EmployeesController::class, 'changeRole'])->middleware(['permission:rolesPermissionsAdmin'])->name('changeRoleEmployee');
    Route::put('/employees/{user}/change-pass', [EmployeesController::class, 'changePassword'])->name('changePasswordEmployee');
    Route::put('/employees/{user}/delete-avatar', [EmployeesController::class, 'deleteAvatar'])->name('deleteAvatarEmployee');

    //Invoice
    Route::get('/invoice/{order}', [DocumentController::class, 'generateInvoice'])->middleware(['permission:closeOrder|rejectOrder|readyOrder'])->name('generateInvoice');
    Route::get('/client-offer/{offer}', [DocumentController::class, 'getOffer'])->middleware(['permission:makeOrder'])->name('generateProductList');

    //Admin
    Route::get('/admin/company-details', [CompanyDetailsController::class, 'edit'])->middleware(['permission:companyDetailsAdmin'])->name('companyDetailsAdmin');
    Route::put('/admin/company-details/update', [CompanyDetailsController::class, 'update'])->middleware(['permission:companyDetailsAdmin'])->name('updateCompanyDetailsAdmin');

    Route::get('/admin/employee-manager', [EmployeeController::class, 'create'])->middleware(['permission:employeeAdmin'])->name('employeeManagerAdmin');
    Route::post('/admin/employee-manager', [EmployeeController::class, 'store'])->middleware(['permission:employeeAdmin'])->name('storeEmployeeAdmin');

    Route::get('/admin/roles-permissions', [RolesController::class, 'index'])->middleware(['permission:rolesPermissionsAdmin'])->name('rolesPermissionsAdmin');
    Route::post('/admin/roles', [RolesController::class, 'storeRole'])->middleware(['permission:rolesPermissionsAdmin'])->name('storeRoleAdmin');
    Route::post('/admin/permissions', [RolesController::class, 'storePermission'])->middleware(['permission:rolesPermissionsAdmin'])->name('storePermissionAdmin');
    Route::delete('/admin/roles/{role}', [RolesController::class, 'destroyRole'])->middleware(['permission:rolesPermissionsAdmin'])->name('destroyRoleAdmin');

    Route::get('/admin/settings', [SettingsController::class, 'index'])->middleware(['permission:settingsAdmin'])->name('settingsAdmin');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->middleware('guest')->name('authenticate');
});

Route::get('/email/verify', [AuthController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/resend', [AuthController::class, 'resend'])->name('verification.resend');
