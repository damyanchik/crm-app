<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CSVImportController;

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
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/ajax/search-users', [AjaxController::class, 'searchUser'])
        ->name('ajax.searchUsers');
    Route::get('/ajax/search-clients', [AjaxController::class, 'searchClient'])
        ->name('ajax.searchClients');
    Route::get('/ajax/search-brands', [AjaxController::class, 'searchBrand'])
        ->name('ajax.searchBrands');
    Route::get('/ajax/search-product-categories', [AjaxController::class, 'searchProductCategory'])
        ->name('ajax.searchProductCategories');
    Route::get('/ajax/search-products', [AjaxController::class, 'searchProduct'])
        ->name('ajax.searchProducts');

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat');
    Route::get('/chat/ajax/load-messages', [ChatController::class, 'loadMessages'])
        ->name('ajax.loadMessages');
    Route::post('/chat/broadcast', [PusherController::class, 'broadcast']);
    Route::post('/chat/receive', [PusherController::class, 'receive']);

    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar');
    Route::post('/calendar', [CalendarController::class, 'store'])
        ->middleware(['permission:storeCalendar'])
        ->name('storeCalendar');
    Route::delete('/calendar/{event}', [CalendarController::class, 'destroy'])
        ->middleware(['permission:destroyCalendar'])
        ->name('destroyCalendar');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])
        ->middleware(['permission:storeProduct'])
        ->name('createProduct');
    Route::post('/products', [ProductController::class, 'store'])
        ->middleware(['permission:storeProduct'])
        ->name('storeProduct');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->middleware(['permission:updateProduct'])
        ->name('editProduct');
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->middleware(['permission:updateProduct'])
        ->name('updateProduct');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware(['permission:destroyProduct'])
        ->name('destroyProduct');
    Route::put('/products/{product}/delete-product-photo', [ProductController::class, 'deletePhoto'])
        ->middleware(['permission:destroyProduct'])
        ->name('destroyProductPhoto');

    Route::get('/brands', [BrandController::class, 'index'])
        ->name('brands');
    Route::get('/brands/create', [BrandController::class, 'create'])
        ->middleware(['permission:storeBrand'])
        ->name('createBrand');
    Route::post('/brands', [BrandController::class, 'store'])
        ->middleware(['permission:storeBrand'])
        ->name('storeBrand');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])
        ->middleware(['permission:updateBrand'])
        ->name('editBrand');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])
        ->middleware(['permission:updateBrand'])
        ->name('updateBrand');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])
        ->middleware(['permission:destroyBrand'])
        ->name('destroyBrand');

    Route::get('/product-categories', [ProductCategoryController::class, 'index'])
        ->name('prodCats');
    Route::get('/product-categories/create', [ProductCategoryController::class, 'create'])
        ->middleware(['permission:storeProductCategory'])
        ->name('createProdCat');
    Route::post('/product-categories', [ProductCategoryController::class, 'store'])
        ->middleware(['permission:storeProductCategory'])
        ->name('storeProdCat');;
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoryController::class, 'edit'])
        ->middleware(['permission:updateProductCategory'])
        ->name('editProdCat');;
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update'])
        ->middleware(['permission:updateProductCategory'])
        ->name('updateProdCat');;
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'destroy'])
        ->middleware(['permission:destroyProductCategory'])
        ->name('destroyProdCat');;

    Route::get('/offers', [OfferController::class, 'index'])
        ->name('offers');
    Route::get('/offers/create', [OfferController::class, 'create'])
        ->middleware(['permission:storeOffer'])
        ->name('createOffer');
    Route::post('/offers', [OfferController::class, 'store'])
        ->middleware(['permission:storeOffer'])
        ->name('storeOffer');
    Route::get('/offers/{offer}/edit', [OfferController::class, 'edit'])
        ->middleware(['permission:updateOffer'])
        ->name('editOffer');
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])
        ->middleware(['permission:destroyOffer'])
        ->name('destroyOffer');
    Route::put('/offers/{offer}', [OfferController::class, 'update'])
        ->middleware(['permission:updateOffer'])
        ->name('updateOffer');
    Route::put('/offers/make-order/{offer}', [OfferController::class, 'makeOrder'])
        ->middleware(['permission:makeOrder'])
        ->name('makeOrder');

    Route::post('/offers/create', [CSVImportController::class, 'importToOffer'])
        ->middleware(['permission:storeOffer'])
        ->name('importOffer');
    Route::post('/products/import-new-product', [CSVImportController::class, 'importToStoreProducts'])
        ->middleware(['permission:storeProduct'])
        ->name('importNewProduct');
    Route::post('/products/import-update-product', [CSVImportController::class, 'importToUpdateQuantityAndPrice'])
        ->middleware(['permission:storeProduct'])
        ->name('importUpdateProduct');

    Route::get('/orders/archive', [ArchiveController::class, 'index'])
        ->name('orderArchives');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('showOrder');
    Route::put('/orders/{order}/ready', [OrderController::class, 'ready'])
        ->middleware(['permission:readyOrder'])
        ->name('readyOrder');
    Route::put('/orders/{order}/reject', [OrderController::class, 'reject'])
        ->middleware(['permission:rejectOrder'])
        ->name('rejectOrder');
    Route::put('/orders/{order}/close', [OrderController::class, 'close'])
        ->middleware(['permission:closeOrder'])
        ->name('closeOrder');

    Route::get('/clients', [ClientController::class, 'index'])
        ->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])
        ->middleware(['permission:storeClient'])
        ->name('createClient');
    Route::get('/clients/{client}', [ClientController::class, 'show'])
        ->name('showClient');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])
        ->middleware(['permission:updateClient'])
        ->name('editClient');
    Route::put('/clients/{client}', [ClientController::class, 'update'])
        ->middleware(['permission:updateClient'])
        ->name('updateClient');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])
        ->middleware(['permission:destroyClient'])
        ->name('destroyClient');
    Route::post('/clients', [ClientController::class, 'store'])
        ->middleware(['permission:storeClient'])
        ->name('storeClient');

    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees');
    Route::get('/employees/{user}', [EmployeeController::class, 'show'])
        ->name('showEmployee');
    Route::get('/employees/{user}/edit', [EmployeeController::class, 'edit'])
        ->name('editEmployee');
    Route::put('/employees/{user}', [EmployeeController::class, 'update'])
        ->name('updateEmployee');
    Route::post('/employees/{user}/block', [EmployeeController::class, 'block'])
        ->middleware(['permission:blockUser'])
        ->name('blockEmployee');
    Route::put('/employees/{user}/change-role', [EmployeeController::class, 'changeRole'])
        ->middleware(['permission:rolesPermissionsAdmin'])
        ->name('changeRoleEmployee');
    Route::put('/employees/{user}/change-pass', [EmployeeController::class, 'changePassword'])
        ->name('changePasswordEmployee');
    Route::put('/employees/{user}/delete-avatar', [EmployeeController::class, 'deleteAvatar'])
        ->name('deleteAvatarEmployee');

    Route::get('/invoice/{order}', [DocumentController::class, 'generateInvoice'])
        ->middleware(['permission:closeOrder|rejectOrder|readyOrder'])
        ->name('generateInvoice');
    Route::get('/client-offer/{offer}', [DocumentController::class, 'getOffer'])
        ->middleware(['permission:makeOrder'])
        ->name('generateProductList');

    Route::get('/admin/company-details', [CompanyController::class, 'edit'])
        ->middleware(['permission:companyDetailsAdmin'])
        ->name('companyDetailsAdmin');
    Route::put('/admin/company-details/update', [CompanyController::class, 'update'])
        ->middleware(['permission:companyDetailsAdmin'])
        ->name('updateCompanyDetailsAdmin');

    Route::get('/admin/employee-manager', [EmployeeController::class, 'create'])
        ->middleware(['permission:employeeAdmin'])
        ->name('employeeManagerAdmin');
    Route::post('/admin/employee-manager', [EmployeeController::class, 'store'])
        ->middleware(['permission:employeeAdmin'])
        ->name('storeEmployeeAdmin');

    Route::get('/admin/roles-permissions', [RoleController::class, 'index'])
        ->middleware(['permission:rolesPermissionsAdmin'])
        ->name('rolesPermissionsAdmin');
    Route::post('/admin/roles', [RoleController::class, 'storeRole'])
        ->middleware(['permission:rolesPermissionsAdmin'])
        ->name('storeRoleAdmin');
    Route::post('/admin/permissions', [RoleController::class, 'storePermission'])
        ->middleware(['permission:rolesPermissionsAdmin'])
        ->name('storePermissionAdmin');
    Route::delete('/admin/roles/{role}', [RoleController::class, 'destroyRole'])
        ->middleware(['permission:rolesPermissionsAdmin'])
        ->name('destroyRoleAdmin');

    Route::get('/admin/settings', [SettingController::class, 'index'])
        ->middleware(['permission:settingsAdmin'])
        ->name('settingsAdmin');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login')
        ->middleware('guest');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])
        ->middleware('guest')
        ->name('authenticate');
});

Route::get('/email/verify', [AuthController::class, 'show'])
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');
Route::post('/email/resend', [AuthController::class, 'resend'])
    ->name('verification.resend');
