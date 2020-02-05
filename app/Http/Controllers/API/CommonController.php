<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Quotes;
use App\Models\Client;
use App\Models\QuotesItem;
use App\Models\invoice;
use App\Models\TaxRate;
use App\Models\Product;
use App\Models\productmap;
use App\Models\quotes_item_amount;
use App\Models\quote_notes;
use App\Models\Currencies;
use App\Models\Invoice_status_master;
use App\Models\Company;
use App\Models\quotes_amount;
use App\Models\PaymentMethod;
use App\Models\quotes_status_master;
use App\Models\CategoryMethod;
use App\Models\System;
use App\Models\Payment;

use App\Models\User;

use Input;
use File;
use Redirect;
use PDF;
use App;
use Auth;
use Response;

class CommonController extends Controller
{

  /**
     * @SWG\Get(
     *          path="/autoComplete",
     *          tags={"COMMONAPI"},
     *          summary="Auto complete",
     *          operationId="Aid",
     *          @SWG\Parameter(
     *              name="invoice_id/quotes_id",
     *              description="Invoice Id or Quotes Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function autoComplete(Request $request)
  {

    $data = $request->client_name;

    $client = client::where('client_name', 'like', '%' . $data . '%')->where('status','=',1)->get();
    $filterQuoteArray = array();
    foreach ($client as $key => $value) {
      $filterQuoteArray[] =  $value->client_name;
    }
    //echo "<pre>IN_NO";($filterQuoteArray);exit;
    return response()->json(['error' => false, 'message' => "success", "autocomplete" => $filterQuoteArray], 200);
  }

  /**
     * @SWG\Get(
     *          path="/autoProduct",
     *          tags={"COMMONAPI"},
     *          summary="Auto complete Product",
     *          operationId="Aid",
     *          @SWG\Parameter(
     *              name="product_id",
     *              description="Product_id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function autoProduct(Request $request)
  {
    // echo "<pre>";($request);exit;
    $data = $request->product_name;
    $product = product::where('product_name', 'like', '%' . $data . '%')
      ->leftJoin('productmaps', 'products.id', '=', 'productmaps.product_id')
      ->where('productmaps.status','=',1)
      
       ->where('productmaps.deleted_at', '=', NULL)
      ->get();
    $filterArray = array();
    $filtergetPrice = array();
    $getProduct = array();
    $filterProductArray = array();
    $filterDescription = array();

    foreach ($product as $key => $value) {
      $filterProductArray[] = $value->display_name;
      $filterArray[] = $value->id;
      $filterDescription[] = $value->description;
      $filtergetPrice[] = $value->price;
    }
    return response()->json(['error' => false, 'message' => "success", "product_details" => $filterArray, "product" => $filterProductArray, "description" => $filterDescription, "price" => $filtergetPrice], 200);
  }

    /**
     * @SWG\Get(
     *          path="/systemdate",
     *          tags={"COMMONAPI"},
     *          summary="DateFormat",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function systemdate()
  {
    $system = System::select('value')->where('key', '=', 'date')->first()['value'];
    $value = ["ca-ES" => 'DD/MM/YYYY', "fa-IR" => 'MM/DD/YYYY', "ja-JP" => 'YYYY/MM/DD', "da-DK" => 'DD-MM-YYYY', "sma-SE" => 'YYYY-MM-DD'];
    return response::json(['error' => false, 'message' => "success", "systemDate" => $system, "systemValue" => $value[$system]], 200);
    // echo"<pre>system";print_r($system);
  }

   /**
     * @SWG\Get(
     *          path="/systemquantities",
     *          tags={"COMMONAPI"},
     *          summary="System",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function systemquantities()
  {
    $system = System::select('value')
      ->where('key', '=', 'quantities')
      ->first()['value'];
    return response::json(['error' => false, 'messsage' => "success", "systemQuantities" => $system], 200);
  }


 /**
     * @SWG\Get(
     *          path="/taxrounding",
     *          tags={"COMMONAPI"},
     *          summary="Taxrounding",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function taxrounding()
  {
    $system = System::select('value')->where('key', '=', 'tax_rounding')->first()['value'];
    return response::json(['error' => false, 'message' => "success", "systemTaxrounding" => $system], 200);
  }

  /**
     * @SWG\Get(
     *          path="/listTaxRate",
     *          tags={"COMMONAPI"},
     *          summary="Tax",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function taxrate() 
  {
    $TaxRate = TaxRate::select('id', 'percentage')->get();
    $TaxRateArray = array();
    foreach ($TaxRate as $value) {
      $TaxRateArray[] = [ "id" => $value->id,
            "percentage" => $value->percentage,];
    }
    return response::json(['error' => false, 'message' => "success", "TaxRateDetails" => $TaxRateArray], 200);
  }

   /**
     * @SWG\Get(
     *          path="/category",
     *          tags={"COMMONAPI"},
     *          summary="Category",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function Category()
  {
    $CategoryMethod = CategoryMethod::select('id', 'name')->get();
    $CategoryMethodArray = array();
    foreach ($CategoryMethod as $value) {
      $CategoryMethodArray[] = ["id" => $value->id, "name" => $value->name,];
    }
    return response::json(['error' => false, 'message' => "success", "CategoryMethodDetails" => $CategoryMethodArray], 200);
  }

   /**
     * @SWG\Get(
     *          path="/listStatus",
     *          tags={"COMMONAPI"},
     *          summary="ListStatus",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function listStatus()
  {

    $quotes_status_master = quotes_status_master::select('quotesstatus_id', 'quotesstatus')
      ->where('status', 1)
      ->get();
    $quotes_status_masterArray = array();
    foreach ($quotes_status_master as $value) {
      $quotes_status_masterArray[] = [
        "quotesstatus_id" => $value->quotesstatus_id,
        "quotesstatus" => $value->quotesstatus,
      ];
    }

    return response::json(['status' => 1, 'message' => "success", "statusDetails" => $quotes_status_masterArray], 200);
  }

  /**
     * @SWG\Get(
     *          path="/invoicestatus",
     *          tags={"COMMONAPI"},
     *          summary="InvoiceStatus",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function invoice_status()
  {
    $Invoice_status_master = Invoice_status_master::select('invoicestatus_id', 'invoicestatus')->get();

    $invoice_status_masterArray = array();
    foreach ($Invoice_status_master as $value) {
      $invoice_status_masterArray[] = [

        "invoicestatus_id" => $value->invoicestatus_id,
        "invoicestatus" => $value->invoicestatus,

      ];
    }
    return response::json(['error' => false, 'message' => "success", "invoice_statusDetails" => $invoice_status_masterArray], 200);
  }

  /**
     * @SWG\Get(
     *          path="/Companyview",
     *          tags={"COMMONAPI"},
     *          summary="CompanyView",
     *          operationId="id",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function companyName()
  {
    $company = Company::select('id', 'company_name')->get();

    $companyArray = array();
    foreach ($company as $value) {
      $companyArray[] = [

        "id" => $value->id,
        "company_name" => $value->company_name,

      ];
    }
    return response::json(['error' => false, 'message' => "success", "company_name" => $companyArray], 200);
  }

   /**
     * @SWG\Get(
     *          path="/quotesclient/{id}",
     *          tags={"COMMONAPI"},
     *          summary="CompanyView",
     *          operationId="id",
     * 
     *   @SWG\Parameter(
     *              name="quotes_id",
     *              description="Quotes Id",
     *              required=true,
     *              type="string",
     *              in="path"
     *          ),
     * 
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     *
     */
  public function Quotesdetails($id)
  {

    //echo"<pre>system";print_r($id);exit();
    $quotes = Quotes::select('quotes.quotes_id', 'quotes.currencies_id as currencies_id', 'quote_no', 'date', 'expires_on', 'client_name', 'totalamount', 'quotesstatus')
      ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
      ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')
      ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
      ->where('clients.id', $id)->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)->get();

    $quoteviewArray = array();
    foreach ($quotes as $key => $value) {
      $CurrenciesData = Currencies::select('symbol', 'placement', 'thousands', 'decimal')->where('id', '=', $value->currencies_id)->first();
      $quoteviewArray[] = [
        "currencies_id" => $CurrenciesData['symbol'],
        "currencies_placement" => $CurrenciesData['placement'],
        "currencies_thousands" => $CurrenciesData['thousands'],
        "currencies_decimal" => $CurrenciesData['decimal'],
        "quotes_id" => $value->quotes_id,
        "quote_no" => $value->quote_no,
        "date" => $value->date,
        "expires_on" => $value->expires_on,
        "client_name" => $value->client_name,
        // "currency_id" => Currencies::select('symbol')->where('id', '=', $value->currency_id)->first()['symbol'],
        "totalamount" => $value->totalamount,
        // "currencies_id" => $value->currencies_id,
        //  "status"=>$value->status,
        "quotesstatus" => $value->quotesstatus,

      ];
    }
    // echo"<pre>";print_r($quoteviewArray);exit;

    $invoice = invoice::select('invoices.invoice_id', 'invoice_number', 'date', 'expires_on', 'client_name', 'total', 'invoicestatus', 'balance', 'currency_id')
      ->leftJoin('clients', 'invoices.client_id', '=', 'clients.id')
      ->leftJoin('invoice_status_master', 'invoices.invoice_status_id', '=', 'invoice_status_master.invoicestatus_id')

      ->where('clients.id', $id)->where('invoices.deleted_at', '=', NULL)->where('invoices.invoice_number', '!=', NULL)->get();
    $today = date('Y-m-d');

    $invoiceviewArray = array();
    foreach ($invoice as $key => $value) {
      $CurrenciesData = Currencies::select('symbol', 'placement', 'thousands', 'decimal')->where('id', '=', $value->currency_id)->first();
      $date = $value->expires_on;
      $is_date = 0;
      if ($date <= $today) {

        $is_date = 1;
      }

      array_push($invoiceviewArray, [


        "invoice_id" => $value->invoice_id,
        "currencies_id" => $CurrenciesData['symbol'],
        "currencies_placement" => $CurrenciesData['placement'],
        "currencies_decimal" => $CurrenciesData['decimal'],
        "currencies_thousands" => $CurrenciesData['thousands'],
        "invoice_number" => $value->invoice_number,
        "date" => $value->date,
        "expires_on" => $value->expires_on,
        "client_name" => $value->client_name,
        "balance" => $value->balance,
        "total" => $value->total,
        "status" => $value->invoicestatus,
        "is_date" => $is_date,

      ]);
    }


    $payments = Payment::select('payments.payment_id', 'payment_methods.name as payment_name', 'invoices.invoice_id', 'invoice_number', 'date', 'payment_amount', 'paymenttype_id', 'payment_date', 'note', 'payment_id', 'currency_id', 'client_name')
      ->leftJoin('invoices', 'payments.invoice_id', '=', 'invoices.invoice_id')
      ->leftJoin('clients', 'invoices.client_id', '=', 'clients.id')
      ->leftJoin('payment_methods', 'payments.paymenttype_id', '=', 'payment_methods.id')
      ->where('clients.id', $id)
      ->where('clients.deleted_at', '=', NULL)
      ->where('invoices.deleted_at', '=', NULL)
      ->where('payments.deleted_at', '=', NULL)
      ->get();

    $Paymentarray = array();
    foreach ($payments as $key => $value) {

      $CurrenciesData = Currencies::select('symbol', 'placement', 'thousands', 'decimal')->where('id', '=', $value->currency_id)->first();

      $Paymentarray[] = [
        //'currency_id' => Currencies::select('symbol')->where('id','=',$value->currency_id)->first()['symbol'],
        "currencies_id" => $CurrenciesData['symbol'],
        "currencies_placement" => $CurrenciesData['placement'],
        "currencies_thousands" => $CurrenciesData['thousands'],
        "currencies_decimal" => $CurrenciesData['decimal'],
        'invoice_id' => $value->invoice_id,
        'payment_id' => $value->payment_id,
        'invoice_number' => $value->invoice_number,
        'date' => $value->date,
        'client_name' => $value->client_name,
        'payment_amount' => $value->payment_amount,
        'paymenttype_id' => $value->payment_name,
        'payment_date' => $value->payment_date,
        'note' => $value->note != '' && $value->note != "undefined" ? $value->note : null

      ];
    }

    return response::json(['error' => false, 'message' => "success", "quotesdetails" =>  $quoteviewArray, "invoicedetails" =>  $invoiceviewArray,   "payments" => $Paymentarray], 200);
  }
  
  // public function destroy($id)
  // {
  //   $date = date('Y-m-d H:i:s');
  //   $quotes = quotes::where('quotes_id', $id)->update(['deleted_at' => $date]);
  //   return response::json(['status' => 1, 'message' => "quotes deleted successfully"], 200);
  // }
  // public function invoicedestroy($id)
  // {
  //   //echo $id;exit;
  //   $date = date('Y-m-d H:i:s');
  //   $invoice = invoice::where('invoice_id', $id)->update(['deleted_at' => $date]);
  //   return response::json(['error' => false, 'message' => "Invoice deleted successfully"], 200);
  // }

  public function paymentdestroy($id)

  {
    //echo $id;exit;
    $date = date('Y-m-d H:i:s');

    $payment_amount = payment::where('payment_id', $id)->first();
    $deletedamount = $payment_amount->payment_amount;
    $invoice_id = $payment_amount->invoice_id;


    $invoice = invoice::where('invoice_id', $invoice_id)->first();
    $invoice_balance = $invoice->balance;
    $invoice_paid_amount = $invoice->total_paid_amount;

    $total_balance = ($invoice_balance + $deletedamount);
    $total_paid = ($invoice_paid_amount - $deletedamount);

    $invoice_item_amount = invoice_item_amount::where('invoice_id', $invoice_id)->update(['total_amount' => $total_balance,]);
    $invoice = invoice::where('invoice_id', $invoice_id)->update(['balance' => $total_balance, 'total_paid_amount' => $total_paid,]);
    $payment = payment::where('payment_id', $id)->update(['deleted_at' => $date]);

    return response::json(['error' => false, 'message' => "Payment Deleted successfully"], 200);
  }

  // public function paymentmethod()
	// {
	// 	$PaymentMethod = PaymentMethod::select('id','name')->get();
	//     $paymentmethodArray = array();
  //       foreach($PaymentMethod as $value){
  //         $paymentmethodArray[] = [
		  
  //            "id" => $value->id,
  //           "name" => $value->name,
			
	// 		];
	// 	}
	// 	return response::json(['error' => false, 'message' =>"success", "paymentmethod" => $paymentmethodArray], 200);
	// }
}
