<?php

use Illuminate\Http\Request;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */


header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token, x_csrftoken');



Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});



Route::post('register', 'API\APILoginController@register');



Route::group(['prefix' => 'v1'], function () {
  Route::post('login', 'API\LoginController@login');
  Route::apiResource('invoicetry', 'API\InvoicetryController');
  Route::apiResource('listCurrecnies', 'API\InvoicetryController');
  Route::apiResource('TryDemo', 'API\tryDemoController');
  Route::post('TryDemoCompany', 'API\tryDemoController@trydemo');
  Route::apiResource('freeinvoice', 'API\FreeinvoiceController');
  Route::post('freeinvoiceCompany', 'API\FreeinvoiceController@freeinvoice');


  Route::get('welcome', function () {
    return response()->json(['name' => "Welcome"], 200);
  });
});



Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {

  Route::apiResource('Client', 'API\ClientController');

  Route::get('/getstatus', 'API\DashboardController@quoteindex');
  Route::post('/customdaterange', 'API\DashboardController@CustomDateRange');

  Route::apiResource('getDashboard', 'API\DashboardController');

  Route::post('customdate', 'API\DashboardController@CustomDate');
  Route::apiResource('Quotes', 'API\QuotesController');
  Route::get('/quotesclient/{id}', 'API\CommonController@Quotesdetails');
  Route::delete('/quotesdelete/{id}', 'API\CommonController@destroy');
  Route::delete('/invoicedelete/{id}', 'API\invoiceController@destroy');
  Route::delete('/paymentdelete/{id}', 'API\CommonController@paymentdestroy');
  Route::apiResource('Product', 'API\ProductController');
  Route::post('Product/{id}', 'API\ProductController@productupdate');
  Route::apiResource('Currencies', 'API\CurrenciesController');
  Route::apiResource('Company', 'API\CompanyController');
  Route::apiResource('invoice', 'API\invoiceController');
  Route::apiResource('Taxrate', 'API\TaxrateController');
  Route::apiResource('Payment', 'API\PaymentsController');
  Route::post('/paymentinvoice/{id}', 'API\invoiceController@payment');
  Route::apiResource('ProductUnit', 'API\ProductUnitsController');
  Route::apiResource('PaymentMethod', 'API\PaymentMethodController');
  Route::apiResource('Category', 'API\CategoryController');
  Route::post('UpdateCategory/{id}', 'API\CategoryController@categoryupdate');
  Route::apiResource('System', 'API\SystemController');
  Route::post('/paymentcollectedpreview', 'API\paymentcollectedController@paymentcollectedpreview');
  Route::post('/paymentcollected', 'API\paymentcollectedController@paymentcollected');
  Route::post('/revenueclient', 'API\RevenueclientController@revenueclient');
  Route::post('/revenueclientpreview', 'API\RevenueclientController@revenueclientpreview');
  Route::post('/clientstatementpreview', 'API\ClientstatementController@clientstatementpreview');
  Route::post('/clientstatement', 'API\ClientstatementController@clientstatement');


  Route::get('/client/quote/{id}', 'API\QuotesController@selectclient');
  Route::get('/getclientstatus/{id}', 'API\QuotesController@selectclient');
  // Route::get('/systemdate', 'API\QuotesController@systemdate');
  //Route::get('/systemdate', 'API\invoiceController@systemdate');

 
  Route::get('/autoProduct', 'API\CommonController@autoproduct');
  Route::get('/systemdate', 'API\CommonController@systemdate');
  Route::get('/systemquantities', 'API\CommonController@systemquantities');
  Route::get('/taxrounding', 'API\CommonController@taxrounding');
  Route::get('/autoComplete', 'API\CommonController@autoComplete');
  Route::get('/listTaxRate', 'API\CommonController@taxrate');
  Route::get('/category', 'API\CommonController@Category');
 


  // Route::get('/systemquantities', 'API\QuotesController@systemquantities');

  // Route::get('/taxrounding', 'API\QuotesController@taxrounding');
  //Route::get('/systemquantities', 'API\invoiceController@systemquantities');
  //Route::get('/taxrounding', 'API\invoiceController@taxrounding');

  // Route::post('/update/{id}','API\SystemController@updatesystem');
  Route::get('/updatesystem/{id}', 'API\SystemController@updatesystem');
  //   Route::apiResource('Payments','APi\PaymentsController');
  Route::post('/quoteUpdate', 'API\QuotesController@update');
  // Route::get('autoComplete', 'API\QuotesController@autoComplete');
  //Route::get('autoProduct', 'API\QuotesController@autoProduct');
  Route::get('/Autounit', 'API\ProductController@autounit');


  Route::get('pdfviewquote/{id}', 'API\QuotesController@pdfview');
  // Route::get('pdfviewclientstatement/{id}', 'API\ClientstatementController@clientstatement');
  Route::post('/getquoteno', 'API\QuotesController@getquoteno');
  Route::get('/edit/{id}', 'API\QuotesController@edit');
  Route::post('/update/{id}', 'API\QuotesController@updatequote');
  Route::post('/deletenote', 'API\QuotesController@deletenote');
  Route::post('/deletefiles', 'API\QuotesController@deletefiles');
  Route::post('/quotescopy', 'API\QuotesController@copy');
  Route::post('/updatequotedetails', 'API\QuotesController@updatedata');

 
  
  //Route::get('/Auto', 'API\InvoicetryController@autocomplete');
  //Route::get('/Autoproduct', 'API\invoiceController@autoproduct');
  Route::post('/invoiceno', 'API\invoiceController@invoicenumber');

  Route::get('/pdfview/{id}', 'API\invoiceController@pdfview');
  Route::get('/paymentview/{id}', 'API\invoiceController@paymentView');
  Route::get('/invoiceView/{id}', 'API\invoiceController@edit');

  Route::post('/invoiceupdate', 'API\invoiceController@update');
  Route::post('/updateInvoice', 'API\invoiceController@updateinvoice');

  // Route::get('/category', 'API\ProductController@Category');

  // Route::get('/listTaxRate', 'API\ProductController@taxrate');

  Route::get('/paymethod', 'API\PaymentsController@paymethod');
  Route::post('/paymentcollected', 'API\paymentcollectedController@paymentcollected');
  Route::post('/revenueclient', 'API\RevenueclientController@revenueclient');


  Route::get('/invoicestatus', 'API\CommonController@invoice_status');
  Route::get('/Companyview', 'API\CommonController@companyName');
  Route::post('/filter', 'API\invoiceController@filter');
  Route::post('/filterquotes', 'API\QuotesController@filter');
  Route::post('/invoicecopy', 'API\invoiceController@copy');

  
 Route::post('/filterDash', 'API\invoiceController@filterDash');

  // Route::get('/listTax', 'API\QuotesController@tax');
  // Route::get('/listCurrency', 'API\QuotesController@currencies');




  Route::get('/listStatus', 'API\CommonController@listStatus');

  // Route::get('ListCategory' ,'API\CategoryController@getCategories');
  Route::get('/listCategory', 'API\CategoryController@getCategories');
  Route::get('/listCategory1', 'API\CategoryController@getCategories');

  Route::post('QuotesItem', 'API\QuotesItemController@itemstore');
  Route::post('/QuotesItem/itemstore', 'API\QuotesController@itemstore');

  Route::post('/company/update/{id}', 'API\CompanyController@update');

  //   Route::get('/userAccounts/list', 'API\userAccountController@index');
  //   Route::post('/userAccounts/store', 'API\userAccountController@store');
  //   Route::get('/userAccounts/edit/{id}', 'API\userAccountController@show');
  //   Route::post('/userAccounts/update/{id}', 'API\userAccountController@update');
  //   Route::get('/userAccounts/destroy/{id}', 'API\userAccountController@destroy');
  //   Route::get('/currency/delete/{id}','API\CurrencyController@destroy');


});
