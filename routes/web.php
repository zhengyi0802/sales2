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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
     ->name('home')->middleware('auth');

Route::resource('/catagories', CatagoryController::class);

Route::resource('/vendors', VendorController::class);

Route::resource('/productModels', ProductModelController::class);

Route::get('/sales/{sales}', [App\Http\Controllers\SalesController::class, 'show'])
     ->name('sales.show');

Route::get('/sales/{sales}/edit', [App\Http\Controllers\SalesController::class, 'edit'])
     ->name('sales.edit');

Route::post('/sales/create', [App\Http\Controllers\SalesController::class, 'create'])
     ->name('sales.create');

Route::any('/sales/update/{sales}', [App\Http\Controllers\SalesController::class, 'update'])
     ->name('sales.update');

Route::any('/sales/{sales}', [App\Http\Controllers\SalesController::class, 'destroy'])
     ->name('sales.destroy');

Route::any('/sales/store', [App\Http\Controllers\SalesController::class, 'store'])
     ->name('sales.store');

Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])
     ->name('sales.index');

Route::resource('/projects', ProjectController::class);

Route::resource('/customers', CustomerController::class);

Route::get('/orders/create2/{customer}', [App\Http\Controllers\OrderController::class, 'create2'])
     ->name('orders.create2');

Route::resource('/orders', OrderController::class);

Route::get('/users/password', [App\Http\Controllers\UserController::class, 'password'])
     ->name('users.password');

Route::any('/users/savePassword', [App\Http\Controllers\UserController::class, 'savePassword'])
     ->name('users.savePassword');

Route::resource('/users', UserController::class);
