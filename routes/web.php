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
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\EApplyController;
use App\Http\Controllers\LockInstallerController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\EcpayController;
use App\Http\Controllers\Promotion1Controller;
use App\Http\Controllers\Promotion2Controller;
use App\Http\Controllers\TestController;
use App\Http\Controllers\EcpayInvoiceController;
use App\Http\Controllers\IssueController;

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

//Route::get('/auth/line', [SocialiteController::class, 'lineLogin']);
//Route::get('/auth/line/callback', [SocialiteController::class, 'lineLoginCallback']);

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

Route::get('/catagories/query', [App\Http\Controllers\CatagoryController::class, 'query'])
     ->name('catagories.query')->middleware('auth');

Route::resource('/catagories', CatagoryController::class)->middleware('auth');

Route::get('/vendors/query', [App\Http\Controllers\VendorController::class, 'query'])
     ->name('vendors.query')->middleware('auth');

Route::resource('/vendors', VendorController::class)->middleware('auth');

Route::get('/productModels/query', [App\Http\Controllers\ProductModelController::class, 'query'])
     ->name('productModels.query')->middleware('auth');;

Route::resource('/productModels', ProductModelController::class)->middleware('auth');;

Route::get('/sales/{sales}/show', [App\Http\Controllers\SalesController::class, 'show'])
     ->name('sales.show')->middleware('auth');;

Route::get('/sales/{sales}/edit', [App\Http\Controllers\SalesController::class, 'edit'])
     ->name('sales.edit')->middleware('auth');;

Route::get('/sales/create', [App\Http\Controllers\SalesController::class, 'create'])
     ->name('sales.create')->middleware('auth');;

Route::any('/sales/update/{sales}', [App\Http\Controllers\SalesController::class, 'update'])
     ->name('sales.update')->middleware('auth');;

Route::any('/sales/{sales}', [App\Http\Controllers\SalesController::class, 'destroy'])
     ->name('sales.destroy')->middleware('auth');;

Route::any('/sales', [App\Http\Controllers\SalesController::class, 'store'])
     ->name('sales.store')->middleware('auth');;

Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])
     ->name('sales.index')->middleware('auth');;

Route::resource('/projects', ProjectController::class)->middleware('auth');;

Route::resource('/customers', CustomerController::class)->middleware('auth');;

Route::get('/orders/create2/{customer}', [App\Http\Controllers\OrderController::class, 'create2'])
     ->name('orders.create2')->middleware('auth');;

Route::get('/orders/{order}/shipment', [App\Http\Controllers\OrderController::class, 'shipment'])
     ->name('orders.shipment')->middleware('auth');;

Route::resource('/orders', OrderController::class)->middleware('auth');;

Route::get('/users/password', [App\Http\Controllers\UserController::class, 'password'])
     ->name('users.password')->middleware('auth');;

Route::any('/users/savePassword', [App\Http\Controllers\UserController::class, 'savePassword'])
     ->name('users.savePassword')->middleware('auth');;

Route::get('/profiles', [App\Http\Controllers\UserController::class, 'profile'])
     ->name('users.profiles')->middleware('auth');;

Route::get('/users/saveProfile', [App\Http\Controllers\UserController::class, 'saveProfile'])
     ->name('users.saveProfile')->middleware('auth');;

Route::get('/users/check_aid', [App\Http\Controllers\UserController::class, 'check_aid'])
     ->name('users.check_aid')->middleware('auth');;

Route::resource('/users', UserController::class)->middleware('auth');;

Route::resource('/shippings', ShippingProcessController::class)->middleware('auth');;

Route::get('/csvs', [App\Http\Controllers\CsvController::class, 'index'])
     ->name('csvs.index')->middleware('auth');;

Route::any('/csvs/imports', [App\Http\Controllers\CsvController::class, 'imports'])
     ->name('csvs.imports')->middleware('auth');;

Route::any('/csvs/store', [App\Http\Controllers\CsvController::class, 'store'])
     ->name('csvs.store')->middleware('auth');;

Route::get('/csv/exports', [App\Http\Controllers\CsvController::class, 'exports'])
     ->name('csvs.exports')->middleware('auth');;

//Route::resource('/inventories', InventoryController::class);

Route::get('/massOrders/{massOrder}/shipment', [App\Http\Controllers\MassOrderController::class, 'shipment'])
     ->name('massOrders.shipment')->middleware('auth');;

Route::resource('/massOrders', MassOrderController::class)->middleware('auth');;

Route::get('/warranties/register', [App\Http\Controllers\WarrantyController::class, 'register'])
     ->name('warranties.register')->middleware('auth');;

Route::resource('/warranties', WarrantyController::class)->middleware('auth');;

Route::get('/checkOrders', [App\Http\Controllers\CheckOrderController::class, 'index'])
     ->name('checkOrders.index')->middleware('auth');;

Route::post('/checkOrders/store', [App\Http\Controllers\CheckOrderController::class, 'store'])
     ->name('checkOrders.store')->middleware('auth');

Route::get('/checkOrders/{customer}/edit', [App\Http\Controllers\CheckOrderController::class, 'edit'])
     ->name('checkOrders.edit')->middleware('auth');

Route::delete('/checkOrders/destroy/{customer}', [App\Http\Controllers\CheckOrderController::class, 'destroy'])
     ->name('checkOrders.destroy')->middleware('auth');

Route::group(['inventories' => 'parent'], function () {
    Route::get('/inventories', [App\Http\Controllers\InventoryController::class, 'index']);
    Route::get('/inventories/table', [App\Http\Controllers\InventoryController::class, 'table']);
});

Route::get('inventories/table', [App\Http\Controllers\InventoryController::class, 'table'])
     ->name('inventories.table')->middleware('auth');

Route::resource('/inventories', InventoryController::class)->middleware('auth');

Route::get('/currencies/query', [App\Http\Controllers\CurrencyController::class, 'query'])
     ->name('currencies.query')->middleware('auth');

Route::resource('/currencies', CurrencyController::class)->middleware('auth');

Route::get('/eapplies/import', [EApplyController::class, 'import'])->name('eapplies.import');

Route::get('/eapplies/export', [EApplyController::class, 'export'])->name('eapplies.export');

Route::any('/eapplies/exports', [EApplyController::class, 'exports'])->name('eapplies.exports');

Route::resource('/eapplies', EApplyController::class)->middleware('auth');

//Route::get('/eapplies/export', [EApplyController::class, 'export'])->name('eapplies.export');

//Route::any('/eapplies/exports', [EApplyController::class, 'exports'])->name('eapplies.exports');

//Route::resource('/lockinstallers', LockInstallerController::class);

Route::resource('/processes', ProcessController::class)->middleware('auth');

Route::resource('/ecpay', EcpayController::class)->middleware('auth');

Route::get('/promotion1/import', [Promotion1Controller::class, 'import'])->name('promotion1.import');

Route::get('/promotion1/export', [Promotion1Controller::class, 'export'])->name('promotion1.export');

Route::any('/promotion1/exports', [Promotion1Controller::class, 'exports'])->name('promotion1.exports');

Route::resource('/promotion1', Promotion1Controller::class)->middleware('auth');

Route::get('/promotion2/import', [Promotion2Controller::class, 'import'])->name('promotion2.import');

Route::get('/promotion2/export', [Promotion2Controller::class, 'export'])->name('promotion2.export');

Route::any('/promotion2/exports', [Promotion2Controller::class, 'exports'])->name('promotion2.exports');

Route::resource('/promotion2', Promotion2Controller::class)->middleware('auth');

Route::get('/invoices/settings', [EcpayInvoiceController::class, 'settings'])
     ->name('invoices.settings');

Route::get('/invoices/GetGovInvoiceWordSetting', [EcpayInvoiceController::class, 'GetGovInvoiceWordSetting'])
     ->name('invoices.GetGovInvoiceWordSetting');

Route::get('/invoices/AddInvoiceWordSetting', [EcpayInvoiceController::class, 'AddInvoiceWordSetting'])
     ->name('invoices.AddInvoiceWordSetting');

Route::get('/invoices/GetInvoiceWordSetting', [EcpayInvoiceController::class, 'GetInvoiceWordSetting'])
     ->name('invoices.GetInvoiceWordSetting');

Route::get('/invoices/UpdateInvoiceWordStatus', [EcpayInvoiceController::class, 'UpdateInvoiceWordStatus'])
     ->name('invoices.UpdateInvoiceWordStatus');

Route::get('/invoices/GetCompanyNameByTaxID', [EcpayInvoiceController::class, 'GetCompanyNameByTaxID'])
     ->name('invoices.GetCompanyNameByTaxID');

Route::post('/invoices/Issue', [EcpayInvoiceController::class, 'Issue'])
     ->name('invoices.Issue');

Route::get('/invoices/DelayIssue', [EcpayInvoiceController::class, 'DelayIssue'])
     ->name('invoices.DelayIssue');

Route::get('/invoices/callback', [EcpayInvoiceController::class, 'callback'])
     ->name('invoices/callback');

Route::post('/invoices/EditDelayIssue', [EcpayInvoiceController::class, 'EditDelayIssue'])
     ->name('invoices.EditDelayIssue');

Route::get('/invoices/TriggerIssue', [EcpayInvoiceController::class, 'TriggerIssue'])
     ->name('invoices.TriggerIssue');

Route::get('/invoices/CancelDelayIssue', [EcpayInvoiceController::class, 'CancelDelayIssue'])
     ->name('invoices.CancelDelayIssue');

Route::post('/invoices/Allowance', [EcpayInvoiceController::class, 'Allowance'])
     ->name('invoices.Allowance');

Route::get('/invoices/AllowanceByCollegiate', [EcpayInvoiceController::class, 'AllowanceByCollegiate'])
     ->name('invoices.AllowanceByCollegiate');

Route::get('/invoices/Invalid', [EcpayInvoiceController::class, 'Invalid'])
     ->name('invoices.Invalid');

Route::get('/invoices/AllowanceInvalid', [EcpayInvoiceController::class, 'AllowanceInvalid'])
     ->name('invoices.AllowanceInvalid');

Route::get('/invoices/AllowanceInvalidByCollegiate', [EcpayInvoiceController::class, 'AllowanceInvalidByCollegiate'])
     ->name('invoices.AllowanceInvalidByCollegiate');

Route::post('/invoices/VoidWithReIssue', [EcpayInvoiceController::class, 'VoidWithReIssue'])
     ->name('invoices.VoidWithReIssue');

Route::get('/invoices/GetIssue', [EcpayInvoiceController::class, 'GetIssue'])
     ->name('invoices.GetIssue');

Route::get('/invoices/GetIssueList', [EcpayInvoiceController::class, 'GetIssueList'])
     ->name('invoices.GetIssueList');

Route::get('/invoices/GetAllowanceList', [EcpayInvoiceController::class, 'GetAllowanceList'])
     ->name('invoices.GetAllowanceList');

Route::get('/invoices/GetInvalid', [EcpayInvoiceController::class, 'GetInvalid'])
     ->name('invoices.GetInvalid');

Route::get('/invoices/GetAllowanceInvalid', [EcpayInvoiceController::class, 'GetAllowanceInvalid'])
     ->name('invoices.GetAllowanceInvalid');

Route::get('/invoices/InvoiceNotify', [EcpayInvoiceController::class, 'InvoiceNotify'])
     ->name('invoices.InvoiceNotify');

Route::get('/invoices/InvoicePrint', [EcpayInvoiceController::class, 'InvoicePrint'])
     ->name('invoices.InvoicePrint');

Route::get('/invoices/issues', [EcpayInvoiceController::class, 'issues'])
     ->name('invoices.issues');

Route::get('/invoices/edit_issue', [EcpayInvoiceController::class, 'editIssue'])
     ->name('invoices.edit_issue');

Route::get('/issues/create', [IssueController::class, 'create'])
     ->name('issues.create');

Route::get('/invoices/allowances', [EcpayInvoiceController::class, 'allowances'])
     ->name('invoices.allowances');
