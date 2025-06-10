<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Auth::routes();
//Route::resource('produ', 'App\Http\Controllers\InvoicesController');
// Route::get('coffe', 'App\Http\Controllers\ProductController');

// Route::resource('sections', 'App\Http\Controllers\SectionsController');
// Route::resource('products', 'App\Http\Controllers\ProductController');
// Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');
Route::get('OrderDetails/add_produ_from_order/{id}', 'App\Http\Controllers\OrderController@add_produ_from_order');
Route::get('search_product_insaid_export_order', 'App\Http\Controllers\ExportController@search_product_insaid_export_order');
Route::post('search_product_insaid_export_order_get', 'App\Http\Controllers\ExportController@search_product_insaid_export_order_get')->name('search_product_insaid_export_order_get');



//Route::post('search_product_insaid_export_order', 'App\Http\Controllers\ExportController@bank_Search_Payment')->name('bank_stetment_report_serch');


////
Route::get('ExportOrderDetails/add_produ_to_order/{id}', 'App\Http\Controllers\ExportController@add_produ_to_order');
Route::get('ExportOrderDetails/add_produ_to_order_bycode/{id}', 'App\Http\Controllers\ExportController@add_produ_to_order_bycode');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('download/{orderNumber}/{file_name}', 'App\Http\Controllers\OrderDetailController@get_file');

 Route::get('View_file/{orderNumber}/{file_name}', 'App\Http\Controllers\OrderDetailController@open_file');
 Route::post('delete_file', 'App\Http\Controllers\OrderDetailController@destroy')->name('delete_file');

// Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');


Route::post('addAttachments', 'App\Http\Controllers\OrderDetailController@addAttachments')->name('addAttachments');



// Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit');

// Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('Status_show');



// Route::get('Invoice_Paid','App\Http\Controllers\InvoicesController@Invoice_Paid');

// Route::get('Invoice_UnPaid','App\Http\Controllers\InvoicesController@Invoice_UnPaid');

// Route::get('Invoice_Partial','App\Http\Controllers\InvoicesController@Invoice_Partial');
// Route::resource('Archive', 'App\Http\Controllers\InvoiceAchiveController');


Route::get('/', function () {
    return view('auth.login
    ');
});
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::resource('users','App\Http\Controllers\UserController');
  //  Route::resource('products','ProductController');
    });
    
    Route::resource('add_payment_representative', 'App\Http\Controllers\PaymentController'); 
     Route::post('order_report/add_payment_continer', 'App\Http\Controllers\PaymentController@payment_continer')->name('add_payment_continer');
Route::resource('all_product', 'App\Http\Controllers\ProductDetailController');
Route::get('all_machine/{id}', 'App\Http\Controllers\ProductController@index');
Route::resource('all_machine/add_machine', 'App\Http\Controllers\ProductController');
Route::post('addProducts', 'App\Http\Controllers\ProductController@store')->name('addProducts');
Route::get('broken_machine/{id}', 'App\Http\Controllers\ProductController@broken_machine_view');
Route::resource('today_bank_statment', 'App\Http\Controllers\BankAccountStatementsController');

Route::resource('today_account_statment', 'App\Http\Controllers\AccountStatementController');

Route::get('account_stetment_report', 'App\Http\Controllers\AccountStatementReport@index')->name('account_stetment_report');
Route::post('account_stetment_report_serch', 'App\Http\Controllers\AccountStatementReport@Search_Payment')->name('account_stetment_report_serch');

Route::get('bank_stetment_report', 'App\Http\Controllers\AccountStatementReport@bank_index')->name('bank_stetment_report');
Route::post('bank_stetment_report_serch', 'App\Http\Controllers\AccountStatementReport@bank_Search_Payment')->name('bank_stetment_report_serch');
Route::post('import_order_serch', 'App\Http\Controllers\OrderController@import_order_serch')->name('import_order_serch');
Route::post('machine_serch', 'App\Http\Controllers\ProductController@machine_serch')->name('machine_serch');
Route::post('order_prodect_code_serch', 'App\Http\Controllers\OrderController@order_prodect_code_serch')->name('order_prodect_code_serch');
Route::post('export_order_prodect_code_serch', 'App\Http\Controllers\ExportController@export_order_prodect_code_serch')->name('export_order_prodect_code_serch');


Route::post('machine_serch_to_export_order', 'App\Http\Controllers\ProductController@machine_serch_to_export_order')->name('machine_serch_to_export_order');
Route::post('machine_serch_to_export_order_bycode', 'App\Http\Controllers\ProductController@machine_serch_to_export_order_bycode')->name('machine_serch_to_export_order_bycode');


Route::post('broken_machine_serch', 'App\Http\Controllers\ProductController@broken_machine_serch')->name('broken_machine_serch');
Route::post('all_product_serch', 'App\Http\Controllers\ProductDetailController@all_product_serch')->name('all_product_serch');


Route::get('product_report', 'App\Http\Controllers\ProductController@product_report_view')->name('product_report');
Route::post('update_location_product', 'App\Http\Controllers\ProductController@update_location_product')->name('update_location_product');
Route::post('product_report_serch', 'App\Http\Controllers\ProductController@product_report_serch')->name('product_report_serch');

Route::get('add_order', 'App\Http\Controllers\OrderController@create1');
Route::post('add_order', 'App\Http\Controllers\OrderController@store');
Route::post('update_status_order', 'App\Http\Controllers\OrderController@Status_Update')->name('update_status_order');
Route::post('update_status_product', 'App\Http\Controllers\ProductController@update_status_product')->name('update_status_product');
Route::post('product_set_proken', 'App\Http\Controllers\ProductController@product_set_proken')->name('product_set_proken');
Route::post('product_remove_from_proken', 'App\Http\Controllers\ProductController@product_remove_from_proken')->name('product_remove_from_proken');
 
Route::get('add_export_order', 'App\Http\Controllers\ExportController@create1');
Route::post('add_export_order', 'App\Http\Controllers\ExportController@store');
Route::post('add_export_order_one_by_one', 'App\Http\Controllers\ExportController@store_one_by_one');
Route::post('add_export_order_one_by_one_bycode', 'App\Http\Controllers\ExportController@store_one_by_one_bycode');

Route::get('add_shop_order', 'App\Http\Controllers\SmallShopController@create1');
Route::post('add_shop_order', 'App\Http\Controllers\SmallShopController@store');
//Route::get('/OrderDetails/{id}', 'App\Http\Controllers\OrderController@getDetailsOrder');
Route::get('/OrderDetails/{id}', 'App\Http\Controllers\ProductController@getDetailsOrder');
Route::get('/OrderDetails_not_recive_product/{id}', 'App\Http\Controllers\ProductController@OrderDetails_not_recive_product');
Route::get('/order_prodect_code/{id}', 'App\Http\Controllers\OrderController@order_prodect_code');
Route::get('/export_order_prodect_code/{id}', 'App\Http\Controllers\ExportController@export_order_prodect_code');
///
Route::get('/prodect_code', 'App\Http\Controllers\ProductController@prodect_code');

Route::post('prodect_code_serch', 'App\Http\Controllers\ProductController@prodect_code_serch')->name('prodect_code_serch');
///
Route::get('/ExportOrderDetails/{id}', 'App\Http\Controllers\ProductController@getExportDetailsOrder');

Route::get('/productDetails/{id}', 'App\Http\Controllers\ProductController@getproductDetails')->name('productDetails');

Route::get('/export_productDetails/{id}', 'App\Http\Controllers\ProductController@getexport_productDetails')->name('export_productDetails');
Route::get('/export_productDetails_box', 'App\Http\Controllers\ProductController@getexport_productBoxcDetails')->name('export_productDetails_box');
Route::get('/export_product_rechose_product', 'App\Http\Controllers\ProductController@getrechose_product')->name('export_product_rechose_product');
Route::get('/import_order_productDetails1', 'App\Http\Controllers\ProductController@getimport_order_productDetails')->name('import_order_productDetails1');
Route::get('/box_insaid_detailes', 'App\Http\Controllers\BoxController@getBoxDetails')->name('box_insaid_detailes');
 

Route::resource('companies', 'App\Http\Controllers\ProductCompanyController');


Route::get('/products/{id}/{category_id}', 'App\Http\Controllers\ProductController@getproductsDetaile');
Route::get('/productsgroup/{id}/{category_id}', 'App\Http\Controllers\ProductController@getproductsGruops');
Route::get('/orderProductDeteil/{id}', 'App\Http\Controllers\ProductController@getorderProductDeteil');
Route::get('/shop_exporter_order/{id}', 'App\Http\Controllers\SmallShopController@getOrder');

Route::get('/shop_orders_detail/{id}', 'App\Http\Controllers\SmallShopController@getDetailsOrder');

Route::resource('import_order', 'App\Http\Controllers\OrderController');

Route::resource('export_order', 'App\Http\Controllers\ExportController');
Route::post('export_order_serch', 'App\Http\Controllers\ExportController@export_order_serch')->name('export_order_serch');
Route::resource('small_shop', 'App\Http\Controllers\SmallShopController');
Route::get('order_file/{id}', 'App\Http\Controllers\ExportController@exporterOrders');
Route::get('user_profile/{id}', 'App\Http\Controllers\UserController@show_profile');


Route::resource('shipmentes', 'App\Http\Controllers\ShipmentController');
Route::post('shipment_serch', 'App\Http\Controllers\ShipmentController@shipment_serch')->name('shipment_serch');

Route::get('add_shipment', 'App\Http\Controllers\ShipmentController@create1');
Route::post('/add_shipment1', 'App\Http\Controllers\ShipmentController@store')->name('add_shipment1');
Route::get('/shipmentDeteile/{id}', 'App\Http\Controllers\ShipmentController@getShipmentDeteil');
Route::post('addAttachmentsShipment', 'App\Http\Controllers\ShipmentController@addAttachments')->name('addAttachmentsShipment');
Route::get('download/{orderNumber}/{file_name}', 'App\Http\Controllers\OrderDetailController@get_file');
Route::post('payment_continer', 'App\Http\Controllers\PaymentController@payment_continer')->name('payment_continer');
 Route::get('View_file_sipment/{orderNumber}/{file_name}', 'App\Http\Controllers\ShipmentController@open_file');
 Route::post('delete_file_sipment', 'App\Http\Controllers\ShipmentController@destroy')->name('delete_file_sipment');
 Route::get('download_file_sipment/{orderNumber}/{file_name}', 'App\Http\Controllers\ShipmentController@get_file');
Route::get('/box_order/{id}', 'App\Http\Controllers\ShipmentController@getboxesOrder');
// Route::resource('import_order', 'App\Http\Controllers\OrderController')->except([
//     'show','store','create1'
// ]);

// Route::get('/import_order/{id}', 'App\Http\Controllers\OrderController@index');


//Route::get('InsaidOrderDetails/add_produ_to_order/{id}', 'App\Http\Controllers\InsaidOrderController@add_produ_to_order');
//Route::post('insaid_order_prodect_code_serch', 'App\Http\Controllers\InsaidOrderController@insaid_order_prodect_code_serch')->name('insaid_order_prodect_code_serch');
//Route::post('machine_serch_to_insaid_order', 'App\Http\Controllers\ProductController@machine_serch_to_insaid_order')->name('machine_serch_to_insaid_order');
Route::get('add_insaid_order', 'App\Http\Controllers\InsaidOrderController@create1');
Route::post('add_insaid_order', 'App\Http\Controllers\InsaidOrderController@store');
Route::post('add_insaid_order_one_by_one', 'App\Http\Controllers\InsaidOrderController@store_one_by_one');
//Route::get('/insaid_order_prodect_code/{id}', 'App\Http\Controllers\InsaidOrderController@export_order_prodect_code');

Route::resource('insaid_order', 'App\Http\Controllers\InsaidOrderController');
Route::post('insaid_order_serch', 'App\Http\Controllers\InsaidOrderController@insaid_order_serch')->name('insaid_order_serch');
//Route::get('order_file/{id}', 'App\Http\Controllers\InsaidOrderController@exporterOrders');
//////////////////////
Route::resource('invoices', 'App\Http\Controllers\InvoiceController');
Route::get('Invoice_Paid','App\Http\Controllers\InvoiceController@Invoice_Paid')->name('Invoice_Paid');
Route::get('Invoice_UnPaid','App\Http\Controllers\InvoiceController@Invoice_UnPaid')->name('Invoice_UnPaid');
Route::get('Invoice_Partial','App\Http\Controllers\InvoiceController@Invoice_Partial')->name('Invoice_Partial');


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
Route::get('add_invoices/{category_id}/{order_id}', 'App\Http\Controllers\InvoiceController@createInvoice');

Route::post('invoice_serch', 'App\Http\Controllers\InvoiceController@invoice_serch')->name('invoice_serch');
Route::resource('box', 'App\Http\Controllers\BoxController');
Route::post('sharbox', 'App\Http\Controllers\BoxController@create')->name('sharbox');
Route::post('remove_product_fom_order', 'App\Http\Controllers\ProductController@removeProductFomOrder')->name('remove_product_fom_order');
Route::post('edit_price_product', 'App\Http\Controllers\ProductController@edit_price_product')->name('edit_price_product');
Route::post('edit_price_product_import', 'App\Http\Controllers\ProductController@edit_price_product_import')->name('edit_price_product_import');
Route::post('rechoce_product_confirm', 'App\Http\Controllers\ProductController@rechoce_product_confirm')->name('rechoce_product_confirm');
Route::post('submit_product', 'App\Http\Controllers\ProductController@submit_product')->name('submit_product');
Route::post('submit_all_product', 'App\Http\Controllers\ProductController@submit_all_product')->name('submit_all_product');

Route::post('unsubmit_product', 'App\Http\Controllers\ProductController@unsubmit_product')->name('unsubmit_product');
Route::post('delete_product', 'App\Http\Controllers\ProductController@delete_product')->name('delete_product');

Route::get('show_invoice/{id}','App\Http\Controllers\InvoiceController@show_invoice')->name('show_invoice');
Route::get('all_invoice', 'App\Http\Controllers\InvoiceController@index');
Route::resource('/all_invoice/add', 'App\Http\Controllers\InvoiceController');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoiceController@show')->name('Status_show');
Route::post('/Status_Update', 'App\Http\Controllers\InvoiceController@Status_Update')->name('Status_Update');
//
Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');

Route::get('/order_report/{id}', 'App\Http\Controllers\OrderController@order_report')->name('order_report');


Route::resource('Archive', 'InvoiceAchiveController');







Route::get('export_invoices', 'InvoicesController@export');


