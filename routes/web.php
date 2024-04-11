<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShippingProcessController;
use App\Http\Controllers\CsvController;
//use App\Http\Controllers\StockController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MassOrderController;
use App\Http\Controllers\WarrantyController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
     ->middleware('auth');

Auth::routes();

Route::get('/locate/{locate}', function($locate) {
    app()->setLocale($locate);
    session()->put('locale', $locate);

    return redirect()->back();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
     ->name('home')->middleware('auth');

Route::resource('/catagories', CatagoryController::class);

Route::resource('/vendors', VendorController::class);

Route::resource('/productModels', ProductModelController::class);

Route::get('/sales/{sales}/show', [App\Http\Controllers\SalesController::class, 'show'])
     ->name('sales.show');

Route::get('/sales/{sales}/edit', [App\Http\Controllers\SalesController::class, 'edit'])
     ->name('sales.edit');

Route::get('/sales/create', [App\Http\Controllers\SalesController::class, 'create'])
     ->name('sales.create');

Route::any('/sales/update/{sales}', [App\Http\Controllers\SalesController::class, 'update'])
     ->name('sales.update');

Route::any('/sales/{sales}', [App\Http\Controllers\SalesController::class, 'destroy'])
     ->name('sales.destroy');

Route::any('/sales', [App\Http\Controllers\SalesController::class, 'store'])
     ->name('sales.store');

Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])
     ->name('sales.index');

Route::resource('/projects', ProjectController::class);

Route::resource('/customers', CustomerController::class);

Route::get('/orders/create2/{customer}', [App\Http\Controllers\OrderController::class, 'create2'])
     ->name('orders.create2');

Route::get('/orders/{order}/shipment', [App\Http\Controllers\OrderController::class, 'shipment'])
     ->name('orders.shipment');

Route::resource('/orders', OrderController::class);

Route::get('/users/password', [App\Http\Controllers\UserController::class, 'password'])
     ->name('users.password');

Route::any('/users/savePassword', [App\Http\Controllers\UserController::class, 'savePassword'])
     ->name('users.savePassword');

Route::get('/profiles', [App\Http\Controllers\UserController::class, 'profile'])
     ->name('users.profiles');

Route::get('/users/saveProfile', [App\Http\Controllers\UserController::class, 'saveProfile'])
     ->name('users.saveProfile');

Route::resource('/users', UserController::class);

Route::resource('/shippings', ShippingProcessController::class);

Route::get('/csvs', [App\Http\Controllers\CsvController::class, 'index'])
     ->name('csvs.index');

Route::any('/csvs/imports', [App\Http\Controllers\CsvController::class, 'imports'])
     ->name('csvs.imports');

Route::any('/csvs/store', [App\Http\Controllers\CsvController::class, 'store'])
     ->name('csvs.store');

Route::get('/csv/exports', [App\Http\Controllers\CsvController::class, 'exports'])
     ->name('csvs.exports');

//Route::resource('/inventories', InventoryController::class);

Route::get('/massOrders/{massOrder}/shipment', [App\Http\Controllers\MassOrderController::class, 'shipment'])
     ->name('massOrders.shipment');

Route::resource('/massOrders', MassOrderController::class);

Route::get('/warranties/register', [App\Http\Controllers\WarrantyController::class, 'register'])
     ->name('warranties.register');

Route::resource('/warranties', WarrantyController::class);

Route::get('/checkOrders', [App\Http\Controllers\CheckOrderController::class, 'index'])
     ->name('checkOrders.index');

Route::post('/checkOrders/store', [App\Http\Controllers\CheckOrderController::class, 'store'])
     ->name('checkOrders.store');

Route::get('/checkOrders/{customer}/edit', [App\Http\Controllers\CheckOrderController::class, 'edit'])
     ->name('checkOrders.edit');

Route::delete('/checkOrders/destroy/{customer}', [App\Http\Controllers\CheckOrderController::class, 'destroy'])
     ->name('checkOrders.destroy');

Route::group(['inventories' => 'parent'], function () {
    Route::get('/inventories', [App\Http\Controllers\InventoryController::class, 'index']);
    Route::get('/inventories/table', [App\Http\Controllers\InventoryController::class, 'table']);
});

Route::get('inventories/table', [App\Http\Controllers\InventoryController::class, 'table'])
     ->name('inventories.table');

Route::resource('/inventories', InventoryController::class);
