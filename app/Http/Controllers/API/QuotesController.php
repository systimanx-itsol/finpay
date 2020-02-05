<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Client;
use App\Models\QuotesItem;
use App\Models\TaxRate;
use App\Models\Product;
use App\Models\productmap;
use App\Models\quotes_item_amount;
use App\Models\quote_notes;
use App\Models\quote_attachements;
use App\Models\Currencies;
use App\Models\quotes_status_master;
use App\Models\quotes_amount;
use App\Models\System;
use App\Models\Company;
use App\Models\User;
use Elibyy\TCPDF\TCPDFHelper;
use PDF;
use TCPDF;
use Input;
use File;
use Redirect;

use App;

// use APP\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use Auth;
use Response;

class QuotesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  /**
   * @SWG\Get(
   *          path="/Quotes",
   *          tags={"QUOTES"},
   *          summary="Quotes Table",
   *          operationId="qid",
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
  public function index()
  {
    $quotes = Quotes::select('clients.client_name as client_name', 'quotes.quotes_id as quotes_id', 'quote_no', 'date', 'expires_on', 'quotes_status_master.quotesstatus', 'quotes_amount.totalamount', 'quotes.currencies_id as currencies_id')
      ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
      ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
      ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')
      ->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)->get();

    //  echo"<pre>quoteviewArray";print_r($quoteviewArray);     
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
    // echo"<pre>value";print_r($quoteviewArray);exit;
    return response()->json(['error' => false, 'message' => "success", "quotedetails" => $quoteviewArray], 200);
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  /**
   *
   * @SWG\Post(
   *     path="/Quotes",
   *     description="Quotes Popup",
   *     tags={"QUOTES"},
   *     summary="Quotes Popup",
   *      @SWG\Parameter(
   *          name="client_id",
   *          description="Client Name",
   *          required=true,
   *          type="string",in="formData",
   *      ),
   *      @SWG\Parameter(
   *          name="date",
   *          description="Date",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *     @SWG\Parameter(
   *          name="company_id",
   *          description="Company Name",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *  @SWG\Parameter(
   *          name="quotes_template",
   *          description="group",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   *      @SWG\Parameter(
   *          name="Authorization",
   *          in="header",
   *          description="auth number",
   *          required=true,
   *          type="string"
   *      ),
   *    @SWG\Response(
   *         response=200,
   *         description="Success"
   *     ),
   *  security={
   *           {"Bearer": {}}
   *       }
   * )
   * )
   */
  public function store(Request $request)
  {
    $formData = $request->all();
    //  echo"<pre>";print_r($formData);exit;
    $getClient = Client::where('client_name', $request->client_id)->first();
    $client_id = $getClient->id;


    $quotes = Quotes::create([
      "user_id" => Auth::User()->id,
      "client_id" => $client_id,
      "date" => $request->date,
      "company_id" => $request->company,
      //  "date" => date('Y-m-d', strtotime($request->date)),
      "quote_template" => $request->quote_template,
    ]);

    $quote_id = $quotes->quotes_id;

    // echo"<pre>";print_r( $quotes);exit;

    return response()->json(['status' => 1, 'message' => "submittedsuccess", 'id' => "$quote_id", 'client_id' => "$client_id"], 200);
  }



  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  /**
   * @SWG\get(
   *          path="/Quotes/{id}",
   *          tags={"QUOTES"},
   *          summary="Quotes show",
   *          operationId="qid",
   *          @SWG\Parameter(
   *              name="quotes_id",
   *              description="Quotes Id",
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
  public function show($id)
  {
    // echo "<pre>";
    // print_r($id);
    // exit;
    $client = Quotes::select('client_name', 'date', 'address', 'email', 'phone_number', 'city', 'state', 'web_site', 'country', 'default_currency', 'mobile_number', 'tax_code', 'fax_number', 'postal_code', 'zipcode', 'status')
      ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
      ->where('quotes_id', $id)->first();

    $ClientArray = [
      'client_name' => $client->client_name,
      'address' => $client->address,
      'email' => $client->email,
      'phone_number' => $client->phone_number,
      'city' => $client->city,
      'state' => $client->state,
      'web_site' => $client->web_site,
      'country' => $client->country,
      'mobile_number' => $client->mobile_number,
      'zipcode' => $client->zipcode,
      'default_currency' => $client->default_currency,
      'postal_code' => $client->postal_code,
      'tax_code' => $client->tax_code,
      'fax_number' => $client->fax_number,
      'status' => $client->status,
      'date' => $client->date,
    ];

    // echo "<pre>";
    // print_r($ClientArray);
    // exit;
    // $quotes = Quotes::where('client_id', $id)->first();
    // $quotes_id = $quotes->quotes_id;
    $quotes = Quotes::where('quotes_id', $id)->first();
    $user_id = $quotes->user_id;
    // $company = Quotes::where('quotes_id', $id)->first();
    // $company_id =  $company->company_id;
    $company = Quotes::where('quotes_id', $id)->first();

    $company_id =  $company->company_id;

    // echo "<pre>companyid";
    //   print_r($company_id);
    //   exit;


    $company = Company::select('company_name', 'address', 'city', 'state', 'country', 'zipcode', 'mobile', 'website')
      ->where('id', $company_id)->first();
    // $date = Quotes::select('date')->where('quotes_id', $id)->first();

    $CompanyArray = [
      'company_name' => $company->company_name,
      'address' => $company->address,
      'phone' => $company->phone,
      'city' => $company->city,
      'state' => $company->state,
      'country' => $company->country,
      'zipcode' => $company->zipcode,
      'mobile' => $company->mobile,
      'website' => $company->website,
    ];

    $QuotesDate = date("Y-m-d", strtotime($quotes->date));
    // echo "<pre>date";
    // print_r($CompanyArray);
    // exit;
    $expiryDate = date("Y-m-d", strtotime($quotes->date . '+10 days'));
    return response::json(['error' => false, 'message' => "success", "QuotesDate" => $QuotesDate,  "expiryDate" => $expiryDate,  "ClientDetails" => $ClientArray, "companyDetails" => $CompanyArray], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  //  public function update(Request $request)
  //   {
  //     $n = $request['number_of_products'];
  //     $formdata = $request->all();
  //     // echo"<pre>formdata";print_r($formdata);
  //     $product_names = array();
  //     $descriptions = array();
  //     $quantities = array();
  //     $prices = array();
  //     $tax_rate_values = array();
  //     $totals = array();
  //     for ($i = 0; $i < $n; $i++) {
  //       array_push($product_names, $request['products' . $i . 'product_name']);
  //       array_push($descriptions, $request['products' . $i . 'description']);
  //       array_push($quantities, $request['products' . $i . 'quantity']);
  //       array_push($prices, $request['products' . $i . 'price']);
  //       array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
  //       array_push($totals, $request['products' . $i . 'total']);
  //     }
  //     $temp_product_names = $product_names;
  //     $product_names = array();
  //     for ($i = 0; $i < $n; $i++) {
  //       // echo "<pre>"; print_r($temp_product_names[$i]);
  //       $temp = explode("(", $temp_product_names[$i]);
  //       array_push($product_names, $temp[0]);
  //     }
  //     // echo "<pre>product_names"; print_r($product_names);exit;
  //     $notes = $request->input('note');
  //     $file_names = $request->input('file_name');
  //     $date = $request['date'];
  //     $expires_on = $request['expires_on'];
  //     $discountpercentage = $request['discountpercentage'];
  //     //  echo "<pre>";print_r($formdata);
  //     //   $date = $formdata('date');
  //     //   $expires_on = $formdata('expires_on');
  //     $getQuotes = Quotes::where('quotes_id', $request->id)->first();
  //     // echo "<pre>";print_r($request->id);
  //     $quote_id = $getQuotes->quotes_id;
  //     //  echo "<pre>";print_r($quote_id);
  //     for ($i = 0; $i < $n; $i++) {
  //       $getTaxRate = TaxRate::where('percentage', $tax_rate_values[$i])->first();
  //       // echo"<pre>";print_r($tax_rate_values[$i]);exit;
  //       $tax_rate_id = $getTaxRate->id;
  //       //echo"<pre>";print_r($id);
  //       $getProduct = productmap::where('display_name', $product_names[$i])->first();
  //       $product_id = $getProduct->id;
  //       //  echo"<pre>id";print_r($id);
  //       // $productmap = productmap::where('product_id', $product_id)->first();
  //       // $product_map_id = $productmap->id;
  //       $quotesitem = quotesitem::create([
  //         "product_id" => $product_id,
  //         "quote_id" => $quote_id,
  //         "product_name" => $product_names[$i],
  //         "description" => $descriptions[$i],
  //         "tax_rate_id" => $tax_rate_id,
  //         "tax_rate_value" => $tax_rate_values[$i],
  //         "quantity" => $quantities[$i],
  //         "price" => $prices[$i],
  //         //   "status" => $request->status,
  //       ]);
  //     }
  //     $quotes_item_id = $quotesitem->item_id;
  //     //  echo "<pre>";print_r($quotes_item_id);
  //     // $formData = $request->all();
  //     $getquotes = Quotes::where('quotes_id', $request->id)->first();
  //     $quotes_id = $getquotes->quotes_id;
  //     $quotes_amount = quotes_amount::create([
  //       "quotes_id" => $quotes_id,
  //       "itemtaxtotal" => $request->input('taxtot'),
  //       "discount" => $request->input('discount'),
  //       "itemsubtotal" => $request->input('subtotal'),
  //       "totalamount" => $request->input('wholetotal'),
  //       "created_at" => date('Y-m-d H:i:s'),
  //     ]);
  //     //   $quotes_item_id = $quotes_item->item_id;
  //     //   $sub_total_not_dis =0;
  //     //   for($j=0;$j< count($totals);$j++){
  //     //         $sub_total_not_dis +=$totals[$j];
  //     //   }
  //     $quotes_item_amount = quotes_item_amount::create([
  //       "quotes_item_id" => $quotes_item_id,
  //       "tax_before_total" => $request->subtotal,
  //       "tax" => $request->taxtot,
  //       "discount" => $request->discount,
  //       "total_amount" => $request->wholetotal,
  //     ]);
  //     // $formData = $request->all();
  //     $getQuotes = Quotes::where('quotes_id', $request->id)->first();
  //     $quotes_id = $getQuotes->quotes_id;
  //     $quote_notes = quote_notes::create([
  //       "quotes_id" => $quotes_id,
  //       "note" => $request->note,
  //     ]);
  //     $getQuotes = Quotes::where('quotes_id', $request->id)->first();
  //     $quotes_id = $getQuotes->quotes_id;
  //     if ($request->hasfile('images')) {
  //       $file_index = 1;
  //       foreach ($request->file('images') as $key => $file_name) {
  //         $ext = pathinfo($file_name->getClientOriginalName(), PATHINFO_EXTENSION);
  //         $name =  $formdata['quote_no'] . '_' . $file_index++ . '.' . $ext;
  //         $type = $file_name->getMimeType();
  //         $size = $file_name->getSize();
  //         // $path= public_path().'/files/'.$name;
  //         $path = public_path() . '/files/' . $name;
  //         $file_name->move(public_path() . '/files/', $name);
  //         $quote_attachements = quote_attachements::create([
  //           "quotes_id" => $quotes_id,
  //           "file_name" => $name,
  //           "file_type" => $type,
  //           "file_size" => $size,
  //           "file_path" => $path,
  //         ]);
  //       }
  //     }
  //     $updateData = [
  //       'quote_no' => $formdata['quote_no'],
  //       // 'quote_no' => $request->input('quote_no'),
  //       'date' => date('Y-m-d', strtotime($date)),
  //       'expires_on' => date('Y-m-d', strtotime($expires_on)),
  //       //  'date' => date('',strtotime($date)),
  //       // 'expires_on' => $formdata['expires_on'],
  //       'currencies_id' => $request->currencies_id,
  //       'quotes_status_id' => $request->quotes_status_id,
  //       'discountpercentage' => $formdata['discountpercentage'],
  //       'terms' => $formdata['terms'],
  //       'footer' => $formdata['footer'],
  //     ];
  //     //  'discount' => $formdata['discountpercentage'],
  //     //  echo"<pre>discountpercentage";print_r($formdata['discount']);
  //     $quotes = Quotes::where('quotes_id', $request->id)->update($updateData);
  //     return response::json(['status' => 1, 'message' => "quotesitem updated success", 'tax_rate_id' => $tax_rate_id, 'quote_id' => $quote_id, 'quotes_item_id' => $quotes_item_id], 200);
  //   }


  /**
   *
   * @SWG\Post(
   *     path="/quoteUpdate",
   *     description="Quotes store",
   *     tags={"QUOTES"},
   *     summary="Quotes store",
   *      @SWG\Parameter(
   *          name="quote_no",
   *          description="Quote No",
   *          required=true,
   *          type="string",in="formData",
   *      ),
   *      @SWG\Parameter(
   *          name="date",
   *          description="Date",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *   @SWG\Parameter(
   *          name="expires_on",
   *          description="Expires On",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   *     @SWG\Parameter(
   *          name="discount",
   *          description="Discount",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *  @SWG\Parameter(
   *          name="currencies_id",
   *          description="Currency",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *   @SWG\Parameter(
   *          name="status",
   *          description="Status",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   *  @SWG\Parameter(
   *          name="terms",
   *          description="Terms",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   *  @SWG\Parameter(
   *          name="footer",
   *          description="Footer",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="notes",
   *          description="Notes",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="product_name",
   *          description="Product",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="description",
   *          description="Description",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="quantity",
   *          description="Quantity",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="price",
   *          description="Price",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="tax",
   *          description="Tax",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   * @SWG\Parameter(
   *          name="quotessubtotal",
   *          description="Total",
   *          required=false,
   *          type="string",in="formData",
   *      ),
   * 
   *      @SWG\Parameter(
   *          name="Authorization",
   *          in="header",
   *          description="auth number",
   *          required=true,
   *          type="string"
   *      ),
   *    @SWG\Response(
   *         response=200,
   *         description="Success"
   *     ),
   *  security={
   *           {"Bearer": {}}
   *       }
   * )
   * )
   */
  public function update(Request $request)
  {
    $n = $request['number_of_products'];
    $formdata = $request->all();

    $product_names = array();
    $descriptions = array();
    $quantities = array();
    $prices = array();
    $tax_rate_values = array();
    $totals = array();
    for ($i = 0; $i < $n; $i++) {
      array_push($product_names, $request['products' . $i . 'product_name']);
      array_push($descriptions, $request['products' . $i . 'description']);
      array_push($quantities, $request['products' . $i . 'quantity']);
      array_push($prices, $request['products' . $i . 'price']);
      array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
      array_push($totals, $request['products' . $i . 'total']);
    }
    $temp_product_names = $product_names;
    $product_names = array();
    for ($i = 0; $i < $n; $i++) {
      // echo "<pre>"; print_r($temp_product_names[$i]);
      $temp = explode("(", $temp_product_names[$i]);
      array_push($product_names, $temp[0]);
    }
    // echo "<pre>product_names"; print_r($product_names);exit;
    $notes = $request->input('note');
    $file_names = $request->input('file_name');
    $date = $request['date'];
    $expires_on = $request['expires_on'];
    $discountpercentage = $request['discountpercentage'];

    $getQuotes = Quotes::where('quotes_id', $request->id)->first();

    $quote_id = $getQuotes->quotes_id;

    for ($i = 0; $i < $n; $i++) {

      $getTaxRate = TaxRate::where('percentage', $tax_rate_values[$i])->first();
      $tax_rate_id = $getTaxRate->id;

      $getProduct = productmap::where('display_name', $product_names[$i])->first();
      $product_id = $getProduct->id;

      $quotesitem = quotesitem::create([
        "product_id" => $product_id,
        "quote_id" => $quote_id,
        "product_name" => $product_names[$i],
        "description" => $descriptions[$i],
        "tax_rate_id" => $tax_rate_id,
        "tax_rate_value" => $tax_rate_values[$i],
        "quotessubtotal" =>    $totals[$i],
        "quantity" => $quantities[$i],
        "price" => $prices[$i],
        //   "status" => $request->status,
      ]);
    }
    //echo"<pre>";print_r($quotesitem);exit;
    $quotes_item_id = $quotesitem->item_id;

    $getquotes = Quotes::where('quotes_id', $request->id)->first();
    $quotes_id = $getquotes->quotes_id;

    $quotes_amount = quotes_amount::create([
      "quotes_id" => $quotes_id,
      "itemtaxtotal" => $request->input('taxtot'),
      "discount" => $request->input('discount'),
      "itemsubtotal" => $request->input('subtotal'),
      "totalamount" => $request->input('wholetotal'),
      "created_at" => date('Y-m-d H:i:s'),
    ]);
    // $quotes_item_id = $quotes_item->item_id;
    // $sub_total_not_dis =0;
    // for($j=0;$j< count($totals);$j++){
    //       $sub_total_not_dis +=$totals[$j];
    // }
    $quotes_item_amount = quotes_item_amount::create([
      "quotes_item_id" => $quotes_item_id,
      "quotes_id" => $quotes_id,
      "tax_before_total" => $request->subtotal,
      "tax" => $request->taxtot,
      "discount" => $request->discount,
      "total_amount" => $request->wholetotal,
    ]);
    // $formData = $request->all();
    $getQuotes = Quotes::where('quotes_id', $request->id)->first();
    $quotes_id = $getQuotes->quotes_id;

    $quote_notes = quote_notes::create([
      "quotes_id" => $quotes_id,
      "note" => $request->note,
    ]);
    $getQuotes = Quotes::where('quotes_id', $request->id)->first();
    $quotes_id = $getQuotes->quotes_id;

    if ($request->hasfile('images')) {
      $file_index = 1;
      foreach ($request->file('images') as $key => $file_name) {
        $ext = pathinfo($file_name->getClientOriginalName(), PATHINFO_EXTENSION);
        $name =  $formdata['quote_no'] . '_' . $file_index++ . '.' . $ext;
        $type = $file_name->getMimeType();
        $size = $file_name->getSize();
        // $path= public_path().'/files/'.$name;
        $path = public_path() . '/files/' . $name;
        $file_name->move(public_path() . '/files/', $name);
        $quote_attachements = quote_attachements::create([
          "quotes_id" => $quotes_id,
          "file_name" => $name,
          "file_type" => $type,
          "file_size" => $size,
          "file_path" => $path,
        ]);
      }
    }
    $updateData = [
      'quote_no' => $formdata['quote_no'],
      // 'quote_no' => $request->input('quote_no'),
      'date' => date('Y-m-d', strtotime($date)),
      'expires_on' => date('Y-m-d', strtotime($expires_on)),
      'currencies_id' => $request->currencies_id,
      'quotes_status_id' => $request->quotes_status_id,
      'discountpercentage' => $formdata['discountpercentage'],
      'terms' => $formdata['terms'],
      'footer' => $formdata['footer'],
    ];

    $quotes = Quotes::where('quotes_id', $request->id)->update($updateData);
    return response::json(['status' => 1, 'message' => "quotesitem updated success", 'tax_rate_id' => $tax_rate_id, 'quote_id' => $quote_id, 'quotes_item_id' => $quotes_item_id], 200);
  }





  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  /**
   * @SWG\Delete(
   *          path="/Quotes/{id}",
   *          tags={"QUOTES"},
   *          summary="Quotes Delete",
   *          operationId="iid",
   *          @SWG\Parameter(
   *              name="quotes_id",
   *              description="Quotes Id",
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
  public function destroy($id)
  {
    $date = date('Y-m-d H:i:s');
    $quotes = quotes::where('quotes_id', $id)->update(['deleted_at' => $date]);
    return response::json(['status' => 1, 'message' => "quotes deleted successfully"], 200);
  }

  public function tax()
  {
    $TaxRate = TaxRate::select('id', 'percentage')->get();
    $TaxRateArray = array();
    foreach ($TaxRate as $value) {
      $TaxRateArray[] = [
        "id" => $value->id,
        "percentage" => $value->percentage,
      ];
    }
    return response::json(['error' => false, 'message' => "success", "TaxRateDetails" => $TaxRateArray], 200);
  }

  public function getclient()
  {
    $Client = Client::select('client_name', 'address', 'email', 'phone_number')->get();

    $ClientArray = array();
    foreach ($Client as $value) {
      $ClientArray[] = [
        "id" => $value->id,
        "client_name" => $value->client_name,
        "address" => $value->address,
        "email" => $value->email,
        "phone_number" => $value->phone_number,
        "city" => $value->city,
        "state" => $value->state,
        "mobile_number" => $value->mobile_number,
        "default_currency" => $value->default_currency,
        "status" => $value->status,
        "postal_code" => $value->postal_code,
        "country" => $value->country,
      ];
    }
    // echo "<pre>";
    // print_r($ClientArray);
    return response::json(['error' => false, 'message' => "success", "ClientDetails" => $ClientArray], 200);
  }

  public function autoComplete(Request $request)
  {
    $data = $request->client_name;

    $client = client::where('client_name', 'like', '%' . $data . '%')->where('status', '=', 1)->get();
    $filterQuoteArray = array();
    foreach ($client as $key => $value) {
      $filterQuoteArray[] =  $value->client_name;
      $filterIdArray[] = $value->id;
    }
    return response()->json(['error' => false, 'message' => "success", "quote_details" => $filterQuoteArray], 200);
  }


  public function autoProduct(Request $request)
  {
    $data = $request->product_name;
    $product = product::where('product_name', 'like', '%' . $data . '%')
      ->leftJoin('productmaps', 'products.id', '=', 'productmaps.product_id')
      ->get();
    $filterArray = array();
    $filtergetPrice = array();
    //  $product_id=array();
    $getProduct = array();
    $filterProductArray = array();
    $filterDescription = array();
    //  $filterPrice = array();
    foreach ($product as $key => $value) {
      // $product_id[] = $value->product_id;
      $filterProductArray[] = $value->display_name;

      $filterArray[] = $value->id;
      $filterDescription[] = $value->description;
      $filtergetPrice[] = $value->price;
    }



    return response()->json(['error' => false, 'message' => "success", "product_details" => $filterArray, "product" => $filterProductArray, "description" => $filterDescription, "price" => $filtergetPrice], 200);
  }

  public function pdfview($id)
  {

    // echo "<pre>";
    // print_r($id);exit;
    // if (!$request->client_id) {
    //   $quotes = Quotes::select('client_id')->where('quotes_id', $request->quotes_id)->first();
    //   $data = $quotes->client_id;
    // } else {
    //   $data = $request->client_id;
    // }
    $quotes = Quotes::select('quote_no', 'user_id', 'terms', 'footer', 'date', 'expires_on', 'client_name', 'email', 'address', 'phone_number',  'currencies_id', 'city', 'state', 'postal_code', 'country')
      ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
      ->leftJoin('quotes_item', 'quotes.quotes_id', '=', 'quotes_item.quote_id')
      ->where('quotes_item.quote_id', $id)
      ->first();

    // $Client = Client::select('client_name', 'email', 'address', 'phone_number')->where('id', $data)->first();

    $quotes_item = QuotesItem::select('product_name', 'quantity', 'price', 'tax_rate_value', 'tax_before_total', 'quotessubtotal')
      ->leftJoin('quotes_item_amount', 'quotes_item.quote_id', '=', 'quotes_item_amount.quotes_id')
      ->where('quotes_item.quote_id', $id)->get();
    // echo"<pre>";print_r($quotes_item);exit;
    // $details = Quotes::select('quote_no', 'date', 'expires_on', 'currencies_id', 'user_id')->where('quotes_id', $request->quotes_id)->first();

    // $items = QuotesItem::select('item_id')->where('quote_id', $request->quotes_id)->first();

    $quotes_item_amount = quotes_item_amount::select('tax_before_total', 'discount', 'tax', 'total_amount')->where('quotes_id', $id)->first();
    $currency_id = $quotes->currencies_id;
    $currency = Currencies::select('symbol', 'thousands', 'placement')->where('id', $currency_id)->first();

    // $system = System::select('value')->where('key', '=', 'quantities')->first()['value'];

    $company = Quotes::where('quotes_id', $id)->first();


    $company_id =  $company->company_id;

    $company = Company::select('company_name', 'address', 'city', 'state', 'country', 'zipcode', 'mobile', 'website')
      ->where('id', $company_id)->first();

    // echo"<pre>";print_r($company);exit;

    $logoimage = public_path('/') . '/files/index.jpeg';
    $pdf = new TCPDFHelper('L', 'mm', 'ANSI_A', true, 'UTF-8', false);
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->AddPage('P', 'A4');
    $pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
    $pdf->startTransaction();


    $header = '<html>
        <body>
                        <style>

                        
                            .nameinvocie
                            {
                                 background: #205565 ;
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                color: #f9cc49;
                            }
                            .invoice th {
                                font-family: sans-serif;
                                font-size: 12px;
                                font-weight: 500;
                               background: #205565 ;
                                
                                color: #f9cc49;
                                padding: 4px 12px;
                                text-align:center;
                                font-size:8px;
                            }
                            .title {
                                background-color: #000;
                                border: 1px solid #8f6B29;
                            }
                          
                            h1
                            {font-size:12px !important;

                            }
                            .title1 {
                                background-color: #000;
                                border: 1px solid #8f6B29;
                                line-height: 16px;
                            }
                            span.dsa {
                                color: #f9cc49;
                                background-color: #000;
                                padding: 30px 20px;
                                border: 1px solid #94782b;
                                font-weight: 700;
                                font-size:11px;
                                display: block;
                                line-height: 20px;
                                width:10px;
                            }
                            span.dfdsa {
                                color: #000;
                                background-color: #f9cc49;
                                padding: 30px 20px;
                                border: 1px solid #94782b;
                                font-weight: 700;
                                 font-size:8px;
                                display: block;
                                line-height: 20px;
                                text-transform: uppercase;

                            }
                            .dsgfds
                            {
                                margin-left:50px;
                            }
                            .para
                            {
                                font-size:8px  !important;
                                text-align:center;
                                color:#000;
                                line-height: 20px;
                            }
                            td h2{
                                margin:0;
                                line-height: 5px;
                            }
                        .invoicetool
                        {
                                font-family: sans-serif;
                               font-size:8px;
                                font-weight: 500;
                                background: #205565 ;
                                
                                color: #fff;
                                padding: 4px 12px;
                                text-align:center;
                                font-size:11px;
                                background-color: #000;
                        }
                        .invoicetool1
                        {
                                font-family: sans-serif;
                             font-size:8px;
                                font-weight: 500;
                                background: #205565;
                              
                                color: #000;
                                padding: 4px 12px;
                                text-align:center;
                                font-size:11px;
                                background-color: #f9cc49;
                        }     .invoicetoolsec
                        {
                                font-family: sans-serif;
                               font-size:8px;
                                font-weight: 500;

                                color: #000;
                                padding: 4px 12px;
                                text-align:center;
                                font-size:11px;
                                background-color: #fff;
                        }
                        .cash
                        {
                                font-family: sans-serif;
                                 font-size:8px;
                                font-weight: 500;

                                color: #000;
                                padding: 4px 12px;
                                text-align:center;
                                font-size:11px;
                                background-color: #fff;
                        }.card
                        {
                               border-top:1px solid #000;
                               border-bottom:1px solid #000;
                        }
                        // .invoicesection td
                        // {
                        //         background-color: #fff;
                        //         padding: 4px 12px;
                        //         text-align:center;
                        //         font-size:10px;
                        //         line-height: 20px;
                        // }
                        .namefile
                        {
                            font-size:8px;
                        }
                        .namefile1
                        {
                                border-top:1px solid #000;
                                border-bottom:1px solid #000;
                        }

                    </style>
                    <table cellspacing="0" cellpadding="1">
                        <tr>

                            <td rowspan="1">
                            <br> <br>
            <img src="' . $logoimage . '" alt="HTML5 Icon" class="top" style="margin-top:-5px;width:80px;"></td> 
                           <td></td>
                             <td rowspan="8"><h3>Company Address</h3>
                                    <h4>' . $company->company_name . ' ' . $company->address . ' ' . $company->city . ' ' . $company->zipcode . ' ' . $company->state . ' ' . $company->country . ' ' . $company->mobile . ' ' . $company->website . '</h4>
                             </td>

                        </tr>
                       
                    </table>
                            <br><br><br>

  <table cellspacing="6" cellpadding="3" class="invoicesection">
                   
 <tr>
 <td rowspan="8"><h3>Bill To</h3>
  <h4>' . $quotes->client_name . ' ' . $quotes->email . ' ' . $quotes->address . ' ' . $quotes->phone_number . '</h4>
   
   
 </td>
 <td></td>
 <td></td>
 <td></td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool"># Quote Number</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . $quotes->quote_no . '</td>
    
  </tr>
  <tr>
   <td></td>
 <td></td>
 <td></td>
   <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Date</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . $quotes->date . '</td>
  </tr>
   <tr>
    <td></td>
 <td></td>
 <td></td>
  <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Due Date</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . $quotes->expires_on . '</td>
  </tr>
             
                <br>
               
          </table>
            <table cellspacing="6" cellpadding="3" class="invoicesection">

          
           
           
            <br><br><br>

<tr>
                                                    <th width="20%" style="border:1px solid #000" class="invoicetool">Item</th>

                            <th width="30%" style="border:1px solid #000;font-size:8px" class="invoicetool">Quantity</th>
                            <th width="15%" style="border:1px solid #000;font-size:8px" class="invoicetool">Price</th>
                        <th width="18%" style="border:1px solid #000;font-size:8px" class="invoicetool">Tax</th>
                           <th width="20%" style="border:1px solid #000" class="invoicetool">Total</th>
                        </tr>
                         ';

    $body = '';
    for ($i = 0; $i < count($quotes_item); $i++) {
      $body .= '

                        <tr>
                          <td style="border:1px solid #000;font-size:8px">' . $quotes_item[$i]->product_name . '</td>

                            <td style="border:1px solid #000;font-size:8px">' . $quotes_item[$i]->quantity . '</td>
                               <td style="border:1px solid #000;font-size:8px">' .  ($currency->placement == 0 ? $currency->symbol : '') . ' ' . $quotes_item[$i]->price .  ($currency->placement == 1 ? $currency->symbol : '') . ' ' . '</td>
                        <td style="border:1px solid #000;font-size:8px">' . $quotes_item[$i]->tax_rate_value . ' %</td>
                                  <td style="border:1px solid #000;font-size:8px">' . ($currency->placement == 0 ? $currency->symbol : '') . ' ' . $quotes_item[$i]->quotessubtotal .  ($currency->placement == 1 ? $currency->symbol : '') . ' ' . '</td>
                        
                     
                        </tr>';
    }


    $footer = '</table>

                    <br>    <br>
                
                    <br><br>
                    <table cellspacing="6" cellpadding="3" class="invoicesection">
                  
             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Subtotal</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . ($currency->placement == 0 ? $currency->symbol : '') . ' ' . number_format($quotes_item_amount->tax_before_total, $currency->decimal) . ' ' . ($currency->placement == 1 ? $currency->symbol : '') . '</th>
            </tr>

             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Tax</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec"> ' . ($currency->placement == 0 ? $currency->symbol : '') . ' ' . number_format($quotes_item_amount->tax, $currency->decimal) . ' ' . ($currency->placement == 1 ? $currency->symbol : '') . '</th>
            </tr>

             
             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Discount</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . ($currency->placement == 0 ? $currency->symbol : '') . ' ' . number_format($quotes_item_amount->discount, $currency->decimal) . ' ' . ($currency->placement == 1 ? $currency->symbol : '') . '</th>
            </tr>

            <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Total</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">' . ($currency->placement == 0 ? $currency->symbol : '') . ' ' . number_format($quotes_item_amount->total_amount, $currency->decimal) . ' ' . ($currency->placement == 1 ? $currency->symbol : '') . '</th>
            </tr>
            <br><br><br>
                      
                    </table>
                    <table  cellspacing="6" cellpadding="3" >
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                      <aside>
        <h1><span contenteditable>Additional Notes</span></h1>
        <h2>--------------------------------------------------------------------------------------------------------------------------------------</h2>
            <p><h2>Terms:-  ' . $quotes['terms'] . '</h2></p>
              <p><h2>Footer:-  ' . $quotes['footer'] . '</h2></p>
    </aside> 
    </body>';

    $tcpdf = $header . $body . $footer;

    $pdf->writeHTML($tcpdf, true, false, true, false, '');

    $file = $pdf->Output('quotes.pdf', 'I');
    return $file;


    // $path = public_path() . '/downloadpdf';
    // $excel_name = $request->quotes_id . '.pdf';
    // $path = $path . $excel_name;

    // $file = PDF::loadView('systimanx_quote', ['Client' => $Client, 'System' => $system, 'Company' => $company, 'currency' => $currency,  'quotes' => $quotes, 'details' => $details, 'quotes_item_amount' => $quotes_item_amount, 'currency' => $currency])->save('downloadpdf/' . $request->quotes_id . '.pdf');

    // $file->stream();
    // $fileatt = $file->Output($path, 'F');
    // $resultOutput['error'] = false;
    // $returnPath = url('/') . '/' . 'downloadpdf/' . $excel_name;
    // $resultOutput['outputfile'] = $returnPath;


    // return response()->json(['error' => false, 'message' => "success", 'data' => $resultOutput, 'name' => $excel_name], 200);
  }

  public function getquoteno(Request $request)
  {

    $quotes = Quotes::select('quote_no')->where('quote_no', $request->quote_no)->first();
    if (isset($quotes)) {
      return response()->json(['status' => 0, 'message' => "already exist"]);
    }
    return response()->json(['status' => 1, "quotenodetails" => $request->quote_no], 200);
  }

  public function currencies()
  {
    $Currencies = Currencies::select('id', 'name', 'symbol', 'placement', 'decimal', 'thousands')->get();
    $CurrenciesArray = array();
    foreach ($Currencies as $value) {
      $CurrenciesArray[] = [
        "id" => $value->id,
        "name" => $value->name,
        "symbol" => $value->symbol,
        "placement" => $value->placement,
        "decimal" => $value->decimal,
        "thousands" => $value->thousands,
      ];
    }
    return response::json(['error' => false, 'message' => "success", "currencyDetails" => $CurrenciesArray], 200);
  }

  public function systemdate()
  {
    $system = System::select('value')->where('key', '=', 'date')->first()['value'];
    $value = ["ca-ES" => 'DD/MM/YYYY', "fa-IR" => 'MM/DD/YYYY', "ja-JP" => 'YYYY/MM/DD', "da-DK" => 'DD-MM-YYYY', "sma-SE" => 'YYYY-MM-DD'];
    return response::json(['error' => false, 'message' => "success", "systemDate" => $system, "systemValue" => $value[$system]], 200);
    // echo"<pre>system";print_r($system);
  }

  public function systemquantities()
  {
    $system = System::select('value')
      ->where('key', '=', 'quantities')
      ->first()['value'];
    return response::json(['error' => false, 'messsage' => "success", "systemQuantities" => $system], 200);
  }

  public function currencydecimal()
  {
    $currency = Currencies::select('id', 'decimal', 'name')->get();
    $CurrenciesvalueArray[] = array();
    foreach ($currency as $value) {
      $CurrenciesvalueArray[] = [
        "id" => $value->id,
        "name" => $value->name,
        "decimal" => $value->decimal,
      ];
    }
    return response::json(['error' => false, 'messsage' => "success", "currencyDecimalvalue" => $CurrenciesvalueArray], 200);
  }

  // public function currencythousands(){
  //   $system = System::select('thousands')->where()->first()['value'];
  //   return response::json(['error' => false, 'message'=>"success","systemthousands"=> $system],200);

  // }

  public function taxrounding()
  {
    $system = System::select('value')->where('key', '=', 'tax_rounding')->first()['value'];
    return response::json(['error' => false, 'message' => "success", "systemTaxrounding" => $system], 200);
  }

  public function edit($id)
  {

    $quotes = Quotes::select('quote_no', 'date', 'expires_on', 'discountpercentage', 'quotes_status_id', 'currencies_id', 'client_id', 'summary', 'terms', 'currencies_id', 'footer', 'files', 'clients.client_name', 'clients.web_site', 'clients.email', 'clients.country', 'clients.address', 'clients.phone_number', 'clients.city', 'clients.state', 'clients.mobile_number', 'clients.default_currency', 'clients.postal_code', 'clients.status', 'clients.tax_code', 'clients.fax_number', 'quotes_amount.itemtaxtotal', 'quotes_amount.totalamount')
      ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
      ->leftJoin('quote_notes', 'quotes.quotes_id', '=', 'quote_notes.quotes_id')
      ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
      ->leftJoin('users', 'quotes.user_id', '=', 'users.company_id')
      ->where('quotes.quotes_id', $id)->first();
    // echo"<pre>quotes";print_r($quotes);exit;

    $quotes_item = QuotesItem::select('product_id', 'product_name', 'description', 'quantity', 'price', 'tax_rate_id', 'tax_rate_value', 'quotes_item_amount.tax_before_total')
      ->leftJoin('quotes_item_amount', 'quotes_item.item_id', '=', 'quotes_item_amount.quotes_item_id')
      ->where('quotes_item.quote_id', $id)->get();

    $quotes_note = quote_notes::select('note')->where('quotes_id', $id)->get();




    $quote_attachement = quote_attachements::select('file_name', 'file_path')->where('quotes_id', $id)->get();

    $QuotesdetailArray = [

      // "quotes_id" => $quotes->quotes_id,
      'quote_no' => $quotes->quote_no,
      'date' => $quotes->date,
      'expires_on' => $quotes->expires_on,
      'currencies_id' => $quotes->currencies_id,
      'currency_placement' => Currencies::select('placement')->where('id', '=', $quotes->currencies_id)->first()['placement'],
      'currency_symbol' => Currencies::select('symbol')->where('id', '=', $quotes->currencies_id)->first()['symbol'],
      'discountpercentage' => $quotes->discountpercentage,

      //   'summary'=>$quotes->summary, 
      'terms' => $quotes->terms,
      'footer' => $quotes->footer,
      'quotes_status_id' => $quotes->quotes_status_id,




      'client_name' => $quotes->client_name,
      'email' => $quotes->email,
      'address' => $quotes->address,
      'phone_number' => $quotes->phone_number,
      'city' => $quotes->city,
      'state' => $quotes->state,
      'postal_code' => $quotes->postal_code,
      'country' => $quotes->country,
      "mobile_number" => $quotes->mobile_number,
      "default_currency" => $quotes->default_currency,
      "tax_code" => $quotes->tax_code,
      "fax_number" => $quotes->fax_number,
      "web_site" => $quotes->web_site,
      "status" => $quotes->status,
      "client_id" => $quotes->client_id,

      'products' => $quotes_item,
      'notes' => $quotes_note,
      'files' => $quote_attachement,
      //   'files' => $quote_attachement,  
      'download_path' => url('/') . '/' . 'files/',

    ];

    $quotes = Quotes::where('quotes_id', $id)->first();
    $user_id = $quotes->user_id;

    // $company = user::where('id', $user_id)->first();
    $company_id =  $quotes->company_id;

    // $invoice = invoice::where('invoice_id', $id)->first();

    // $user_id = $invoice->user_id;

    // $company_id =  $invoice->company_id;


    $company = Company::select('company_name', 'address', 'city', 'state', 'country', 'zipcode', 'mobile', 'website')
      ->where('id', $company_id)->first();


    $CompanyArray = [
      'company_name' => $company->company_name,
      'address' => $company->address,
      'phone' => $company->phone,
      'city' => $company->city,
      'state' => $company->state,
      'country' => $company->country,
      'zipcode' => $company->zipcode,
      'mobile' => $company->mobile,
      'website' => $company->website,
    ];

    //echo"<pre>date";print_r($QuotesdetailArray);exit;
    return response::json(['status' => 1, 'message' => "success", "quotesdetails" => $QuotesdetailArray, "companyDetail" => $CompanyArray], 200);
  }


  // public function listcurrencies(){ 
  //     $Currencies = Currencies::select('id', 'name')->get();
  //     $CurrenciesArray = array();
  //     foreach ($Currencies as $value) {
  //       $CurrenciesArray[] = [
  //         "id" => $value->id,
  //         "name" => $value->name,
  //       ];
  //     }
  //     return response::json(['error' => false, 'message' => "success", "listcurrencyDetail" => $CurrenciesArray], 200);
  //   }


  public function deletenote(Request $request)
  {
    $id = $request->id;
    $note = $request->note;


    $quotenote = quote_notes::where('quotes_id', $id)->where('note', $note)->delete();

    return response::json(['status' => 1, 'message' => "note deleted Successfully.."], 200);
  }

  //   public function copy(Request $request)
  //   {

  //       $quotes = Quotes::where('quotes_id', $request->id)->first();
  //       $quotes_id = $quotes->client_id;

  //       $new_quoteno = rand();

  //     $quotes = Quotes::create([
  //       "client_id" => $quotes_id,
  //       'quote_no' => $new_quoteno,
  //       "date" => $request->date,
  //       "user_id" => Auth::User()->id,
  //       "expires_on" => $request->expires_on,
  //       "currency_id" => $request->currency_id,
  //       "discountpercentage" => $request->discountpercentage,
  //       "terms" => $request->terms,
  //       "footer" => $request->footer,
  //       "quote_template" => $request->quote_template,
  //     ]);
  //     $quotes_id_2 = $quotes->quotes_id;

  //     $n = $request['number_of_products'];
  //     $formdata = $request->all();
  //     // $QuotesItem = array();
  //     $product_names = array();
  //     $descriptions = array();
  //     $quantities = array();
  //     $prices = array();
  //     $tax_rate_values = array();
  //     $totals = array();
  //     for ($i = 0; $i < $n; $i++) {
  //       array_push($product_names, $request['products' . $i . 'product_name']);
  //       array_push($descriptions, $request['products' . $i . 'description']);
  //       array_push($quantities, $request['products' . $i . 'quantity']);
  //       array_push($prices, $request['products' . $i . 'price']);
  //       array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
  //       array_push($totals, $request['products' . $i . 'total']);
  //     }
  //     $temp_product_names = $product_names;
  //     $product_names = array();
  //     for ($i = 0; $i < $n; $i++) {
  //         $temp = explode("(", $temp_product_names[$i]);
  //        array_push($product_names, $temp[0]);
  //     }

  //     $notes = $request->input('note');
  //     $file_names = $request->input('file_name');
  //     $date = $request['date'];
  //     $expires_on = $request['expires_on'];


  //     for ($j = 0; $j < $n; $j++) {

  //       $getTaxRate = TaxRate::where('percentage', $tax_rate_values[$j])->first();
  //       $tax_rate_id = $getTaxRate->id;

  //       $getProduct = productmap::where('display_name', $product_names[$j])->first();
  //       $product_id = $getProduct->id;

  //       $quotesitem = quotesitem::create([
  //         "product_id" => $product_id,
  //         "quote_id" => $quotes_id_2,
  //         "product_name" => $product_names[$j],
  //         "description" => $descriptions[$j],
  //         "tax_rate_id" => $tax_rate_id,
  //         "tax_rate_value" => $tax_rate_values[$j],
  //         "quantity" => $quantities[$j],
  //         "price" => $prices[$j],
  //         //   "status" => $request->status,
  //       ]);
  //     }
  //        $quotes_item_id = $quotesitem->item_id;

  //         $quotes_item_amount = quotes_item_amount::create([
  //         "quotes_id" => $quotes_id_2,
  //       "quotes_item_id" => $quotes_item_id, 

  //       "tax_before_total" => $request->subtotal,
  //       "tax" => $request->taxtot,
  //       "discount" => $request->discount,
  //       "total_amount" => $request->wholetotal,
  //     ]);

  //     $quotes_amount = quotes_amount::create([
  //       "quotes_id" => $quotes_id_2,
  //       "itemtaxtotal" => $request->input('taxtot'),
  //       "discount" => $request->input('discount'),
  //       "itemsubtotal" => $request->input('subtotal'),
  //       "totalamount" => $request->input('wholetotal'),
  //       "created_at" => date('Y-m-d H:i:s'),
  //     ]);


  //      $sub_total_not_dis =0;
  //       for($j=0;$j< count($totals);$j++){
  //             $sub_total_not_dis +=$totals[$j];
  //       }

  //     // $quotes_item_amount = quotes_item_amount::create([
  //     //     "quotes_id" => $quotes_id_2,
  //     //   "quotes_item_id" => $quotes_item_id, 

  //     //   "tax_before_total" => $request->subtotal,
  //     //   "tax" => $request->taxtot,
  //     //   "discount" => $request->discount,
  //     //   "total_amount" => $request->wholetotal,
  //     // ]);


  //  $note=explode(',',$request['note']);
  //       foreach($note as $notes)
  //             {
  //                 $quote_notes = quote_notes::create([
  //                     "quotes_id" => $quotes_id_2,
  //                     "note" => $request->note,
  // 					"created_at" => date('Y-m-d H:i:s'),
  //                 ]);
  //             }




  //     if ($request->hasfile('images')) {
  //       $file_index = 1;
  //       foreach ($request->file('images') as $key => $file_name) {
  //         $ext = pathinfo($file_name->getClientOriginalName(), PATHINFO_EXTENSION);
  //         $name =  $formdata['quote_no'] . '_' . $file_index++ . '.' . $ext;
  //         $type = $file_name->getMimeType();
  //         $size = $file_name->getSize();
  //         // $path= public_path().'/files/'.$name;
  //         $path = public_path() . '/files/' . $name;
  //         $file_name->move(public_path() . '/files/', $name);
  //         $quote_attachements = quote_attachements::create([
  //           "quotes_id" => $quotes_id_2,
  //           "file_name" => $name,
  //           "file_type" => $type,
  //           "file_size" => $size,
  //           "file_path" => $path,
  //         ]);
  //       }
  //     }
  // //  echo"<pre>print";print_r($QuotesItem);exit;

  //     return response::json(['status' => 1, 'message' => "copied success", 'tax_rate_id' => $tax_rate_id, 'quote_id' => $quote_id_2, 'quotes_item_id' => $quotes_item_id], 200);
  //   }
  //   public function deletefiles(Request $request)
  //   {
  //     $id = $request->id;
  //     $note = $request->note;


  //     $quote_attachements = quote_attachements::where('quotes_id', $id)->where('file_name', $file_name)->delete();

  //     return response::json(['status' => 1, 'message' => "files deleted Successfully.."], 200);
  //   }

  public function copy(Request $request)
  {
    //echo"<pre>";print_r($request->all());exit;
    $quotes = Quotes::where('quotes_id', $request->id)->first();
    $quotes_id = $quotes->client_id;
    $company_id = $quotes->company_id;

    $new_quoteno = rand();

    $quote = Quotes::create([
      "client_id" => $quotes_id,
      "company_id" => $company_id,
      'quote_no' => $new_quoteno,
      "date" => $request->date,
      "user_id" => Auth::User()->id,
      "expires_on" => $request->expires_on,
      "currencies_id" => $request->currencies_id,
      "discountpercentage" => $request->discountpercentage,
      "quotes_status_id" => $request->quotes_status_id,
      "terms" => $request->terms,
      "footer" => $request->footer,
      "quote_template" => $request->quote_template,
    ]);
    $quotes_id_2 = $quote->quotes_id;
    // echo "<pre>product";
    // print_r($quotes_id_2);
    // exit;

    $n = $request['number_of_products'];
    $formdata = $request->all();

    $product_names = array();
    $descriptions = array();
    $quantities = array();
    $prices = array();
    $tax_rate_values = array();
    $totals = array();
    for ($i = 0; $i < $n; $i++) {
      array_push($product_names, $request['products' . $i . 'product_name']);
      array_push($descriptions, $request['products' . $i . 'description']);
      array_push($quantities, $request['products' . $i . 'quantity']);
      array_push($prices, $request['products' . $i . 'price']);
      array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
      array_push($totals, $request['products' . $i . 'total']);
    }
    //  echo "<pre>";print_r($product_names);
    //  echo "<pre>";print_r($descriptions);
    //  echo "<pre>";print_r($quantities);
    //  echo "<pre>";print_r($prices);
    //  echo "<pre>";print_r($tax_rate_values);
    //  echo "<pre>";print_r($totals);exit;

    $temp_product_names = $product_names;

    $product_names = array();
    for ($i = 0; $i < $n; $i++) {
      $temp = explode("(", $temp_product_names[$i]);
      array_push($product_names, $temp[0]);
    }


    $notes = $request->input('note');
    $file_names = $request->input('file_name');
    //echo "<pre>";print_r($formdata);

    $date = $request['date'];
    $expires_on = $request['expires_on'];





    for ($i = 0; $i < $n; $i++) {


      $getTaxRate = TaxRate::where('percentage', $tax_rate_values[$i])->first();

      $tax_rate_id = $getTaxRate->id;


      $getProduct = productmap::where('display_name', $product_names[$i])->first();
      $product_id = $getProduct->id;

      $quotesitem = quotesitem::create([
        "product_id" => $product_id,
        "quote_id" => $quotes_id_2,
        "product_name" => $product_names[$i],
        "description" => $descriptions[$i],
        "tax_rate_id" => $tax_rate_id,
        "tax_rate_value" => $tax_rate_values[$i],
        "quantity" => $quantities[$i],
        "price" => $prices[$i],
        "quotessubtotal" => $totals[$i],
        //   //   "status" => $request->status,
      ]);
    }

    // echo"<pre>pre";print_r($tax_rate_id);exit;
    $quotes_item_id = $quotesitem->item_id;



    $quotes_amount = quotes_amount::create([
      "quotes_id" => $quotes_id_2,
      "itemtaxtotal" => $request->input('taxtot'),
      "discount" => $request->input('discount'),
      "itemsubtotal" => $request->input('subtotal'),
      "totalamount" => $request->input('wholetotal'),
      "created_at" => date('Y-m-d H:i:s'),
    ]);






    //  $quotes_item_id = $quotesitem->item_id;

    $sub_total_not_dis = 0;
    for ($j = 0; $j < count($totals); $j++) {
      $sub_total_not_dis += $totals[$j];
    }



    $quotes_item_amount = quotes_item_amount::create([
      "quotes_id" => $quotes_id_2,
      "quotes_item_id" => $quotes_item_id,

      "tax_before_total" => $request->subtotal,
      "tax" => $request->taxtot,
      "discount" => $request->discount,
      "total_amount" => $request->wholetotal,
    ]);


    $note = explode(',', $request['note']);
    foreach ($note as $notes) {
      $quote_notes = quote_notes::create([
        "quotes_id" => $quotes_id_2,
        "note" => $request->note,
        "created_at" => date('Y-m-d H:i:s'),
      ]);
    }




    if ($request->hasfile('images')) {
      $file_index = 1;
      foreach ($request->file('images') as $key => $file_name) {
        $ext = pathinfo($file_name->getClientOriginalName(), PATHINFO_EXTENSION);
        $name =  $formdata['quote_no'] . '_' . $file_index++ . '.' . $ext;
        $type = $file_name->getMimeType();
        $size = $file_name->getSize();
        // $path= public_path().'/files/'.$name;
        $path = public_path() . '/files/' . $name;
        $file_name->move(public_path() . '/files/', $name);
        $quote_attachements = quote_attachements::create([
          "quotes_id" => $quotes_id_2,
          "file_name" => $name,
          "file_type" => $type,
          "file_size" => $size,
          "file_path" => $path,
        ]);
      }
    }

    // echo "<pre>";
    // print_r($quotes_item_amount);
    // exit;

    return response::json(['status' => 1, 'message' => "copied success", 'quotes' => $quotes_id_2], 200);
  }

  public function deletefiles(Request $request)
  {
    $id = $request->id;
    $note = $request->note;


    $quote_attachements = quote_attachements::where('quotes_id', $id)->where('file_name', $file_name)->delete();

    return response::json(['status' => 1, 'message' => "files deleted Successfully.."], 200);
  }

  public function updatequote(Request $request)
  {
    $n = $request['number_of_products'];
    $formdata = $request->all();
    $product_names = array();
    $descriptions = array();
    $quantities = array();
    $prices = array();
    $tax_rate_values = array();
    $totals = array();
    for ($i = 0; $i < $n; $i++) {
      array_push($product_names, $request['products' . $i . 'product_name']);
      array_push($descriptions, $request['products' . $i . 'description']);
      array_push($quantities, $request['products' . $i . 'quantity']);
      array_push($prices, $request['products' . $i . 'price']);
      array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
      array_push($totals, $request['products' . $i . 'total']);
    }


    $notes = $request->input('note');

    $notearr = array();

    foreach ($i as $notes) {

      array_merge($notearr, quote_notes::select('note')->where('note', $i)->where('quotes', $quotes_id)->get());
      $flag = false;

      for ($i = 0; $i < $notes . length(); $i++) {
        for ($j = 0; $j < $notes . length(); $j++) {
          if ($notes[i] == $notearr[i]) {
            $flag = false;
          }
        }
        if ($flag == true) {
          $new . push($notes[i]);
        }
      }
    }

    // }
    $file_names = $request->input('file_name');

    //  echo "<pre>";print_r($formdata);

    $date = $request['date'];
    $expires_on = $request['expires_on'];
  }

  public function updatedata(Request $request)
  {

    $notes = $request->input('note');
    $file_names = $request->input('images');


    $date = $request['date'];
    $expires_on = $request['expires_on'];

    // $date = Quotes::where('date',$request->date)->first();

    $quotes = Quotes::where('quotes_id', $request->id)->first();

    $quotes_id = $quotes->quotes_id;

    $formdata = [
      'quote_no' => $request->input('quote_no'),
      'date' => date('Y-m-d', strtotime($date)),

      'expires_on' => date('Y-m-d', strtotime($expires_on)),
      'currencies_id' => $request->input('currencies_id'),
      'quotes_status_id' => $request->input('quotes_status_id'),
      'discountpercentage' => $request->input('discountpercentage'),
      'terms' => $request->input('terms'),
      'footer' => $request->input('footer'),
    ];
    $quotes = Quotes::where('quotes_id',  $quotes_id)->update($formdata);

    $quotesitem = QuotesItem::where('quote_id', $request->id)->first();
    $quote_id = $quotesitem->quote_id;


    $n = $request['number_of_products'];
    $formdata = $request->all();
    $product_ids = array();
    $product_names = array();
    $descriptions = array();
    $quantities = array();
    $prices = array();
    $tax_rate_values = array();
    $tax_rate_ids = array();
    $totals = array();
    $A = array();

    for ($i = 0; $i < $n; $i++) {
      array_push($product_ids, $request['products' . $i . 'product_id']);
      array_push($product_names, $request['products' . $i . 'product_name']);
      array_push($descriptions, $request['products' . $i . 'description']);
      array_push($quantities, $request['products' . $i . 'quantity']);
      array_push($prices, $request['products' . $i . 'price']);
      array_push($tax_rate_values, $request['products' . $i . 'tax_rate_value']);
      array_push($tax_rate_ids, $request['products' . $i . 'tax_rate_id']);
      array_push($totals, $request['products' . $i . 'total']);
    }

    $quote_items = QuotesItem::select('product_id')->where('quote_id', $quote_id)->get();
    foreach ($quote_items as $key => $value) {
      array_push($A, $value->product_id);
    }
    // echo "<pre>C";
    // print_r($A);exit;
    if ($A) {
      foreach ($A as $key => $value) {
        $quotesitem = QuotesItem::select('*')->where('product_id', $value)->get();
        for ($x = 0; $x < count($product_ids); $x++) {
          if ($product_ids[$x] === $value) {
            $quotesitem = [

              "description" => $descriptions[$x],
              "tax_rate_value" => $tax_rate_values[$x],
              "quantity" => $quantities[$x],
              "price" => $prices[$x],
              "quotessubtotal" => $totals[$x],
              "updated_at" => date('Y-m-d H:i:s'),
            ];


            $quotesitem = Quotesitem::where(['product_id' => $value, 'quote_id' => $quote_id])->update($quotesitem);
          }
        }
      }
    }

    $B = $product_ids;

    $C = array_diff($B, $A);

    for ($i = 0; $i < $n; $i++) {


      $getTaxRate = TaxRate::where('percentage', $tax_rate_values[$i])->first();

      $tax_rate_id = $getTaxRate->id;

      $getQuotes = Quotes::where('quotes_id', $request->id)->first();
      $quote_id = $getQuotes->quotes_id;
    }

    if ($C) {
      foreach ($C as $key => $value) {
        for ($i = 0; $i < $n; $i++) {
          if ($product_ids[$i] == $value) {
            $quotesitem = Quotesitem::create([
              "quote_id" => $quote_id,
              "product_id" => $value,
              "product_name" => $product_names[$i],
              "description" => $descriptions[$i],
              "tax_rate_id" => $tax_rate_id,
              "tax_rate_value" => $tax_rate_values[$i],
              "quantity" => $quantities[$i],
              "price" => $prices[$i],
              "quotessubtotal" => $totals[$i],
              "updated_at" => date('Y-m-d H:i:s'),
            ]);
          }
        }
      }
    }

    $D = array_diff($A, $B);

    if ($D) {
      foreach ($D as $key => $value) {
        for ($i = 0; $i < $n; $i++) {

          $date = date('Y-m-d H:i:s');
          $quotesitem = Quotesitem::where(['product_id' => $value, 'quote_id' => $request->id])->update(['deleted_at' => $date]);
        }
      }
    }

    $U = $C;

    if ($U) {
      //     echo"<pre>B";print_r($B);
      // echo "<pre>C";print_r($C);exit;
      foreach ($U as $key => $value) {
        for ($i = 0; $i < $n; $i++) {

          // $quotesitem=[
          //                                  "description" => $descriptions[$i],
          //                                  "tax_rate_id" => $tax_rate_id[$i],
          //                                  "tax_rate_value" => $tax_rate_ids[$i],
          //                                  "quantity" => $quantities[$i],
          //                                  "price" => $prices[$i],
          //                                  "updated_at" => date('Y-m-d H:i:s'),
          //                            ];


          $quotesitem = Quotesitem::where(['product_id' => $request->id, 'quote_id' => $quote_id]);
        }
      }
    }

    $A = array();
    $B = array();
    $C = array();
    $D = array();




    $quote_notes = quote_notes::select('note')->where(['quotes_id' => $quotes_id])->get();

    foreach ($quote_notes as $key => $value) {
      array_push($A, $value->note);
    }
    $B = explode(",", $notes);

    $C = array_diff($B, $A);
    $D = array_diff($A, $B);


    if ($C) {
      foreach ($C as $note) {
        $quote_notes = quote_notes::create([
          "quotes_id" => $quotes_id,
          "note" => $note,
          "created_at" => date('Y-m-d H:i:s'),
        ]);
      }
    }

    if ($D) {
      $date = date('Y-m-d H:i:s');
      foreach ($D as $note) {
        $quote_notes = quote_notes::where(['quotes_id' => $quotes_id, 'note' => $note])->delete();
      }
    }

    $A = array();
    $B = array();
    // $C=array();
    $D = array();




    $quote_attachements = quote_attachements::select('file_name')->where(['quotes_id' => $quotes_id])->get();

    foreach ($quote_attachements as $key => $value) {
      array_push($A, $value->file_name);
    }



    if ($request->hasfile('images')) {
      $file_index = 1;
      foreach ($request->file('images') as $key => $file_name) {
        $ext = pathinfo($file_name->getClientOriginalName(), PATHINFO_EXTENSION);
        $name =  $formdata['quote_no'] . '_' . $file_index++ . '.' . $ext;
        $type = $file_name->getMimeType();
        $size = $file_name->getSize();


        $path = public_path() . '/files/' . $name;

        $file_name->move(public_path() . '/files/', $name);


        $quote_attachements = quote_attachements::create([

          "quotes_id" => $quotes_id,
          "file_name" => $name,
          "file_type" => $type,
          "file_size" => $size,
          "file_path" => $path,
          "created_at" => date('Y-m-d H:i:s'),
        ]);
      }
    }
    $file_name = $request->input('bindfile');
    $B = explode(",", $file_name);


    $D = array_diff($A, $B);


    if ($D) {
      $date = date('Y-m-d H:i:s');
      foreach ($D as $file_name) {
        $quote_attachements = quote_attachements::where(['quotes_id' => $quotes_id, 'file_name' => $file_name])->delete();
      }
    }


    $quotes_amount = [


      "itemtaxtotal" => $request->input('taxtot'),
      "discount" => $request->input('discount'),
      "itemsubtotal" => $request->input('subtotal'),
      "totalamount" => $request->input('wholetotal'),
      "updated_at" => date('Y-m-d H:i:s'),

    ];
    // echo"<pre>total";print_r( $quotes_amount);exit;
    $quotes_amount = quotes_amount::where('quotes_id',  $quotes_id)->update($quotes_amount);

    //  $quotes_item_id = $quotes_item->item_id; 
    $sub_total_not_dis = 0;
    for ($j = 0; $j < count($totals); $j++) {
      $sub_total_not_dis += $totals[$j];
    }

    $quotes_item_amount = [

      // "quotes_item_id" => $quotes_item_id,

      "tax_before_total" => $request->subtotal,
      "tax" => $request->taxtot,
      "discount" => $request->discount,
      "total_amount" => $request->wholetotal,
      "updated_at" => date('Y-m-d H:i:s'),

    ];

    $quotes_item_amount = quotes_item_amount::where('quotes_id',  $quotes_id)->update($quotes_item_amount);

    return response::json(['status' => 1, 'message' => "Quotes updated successfully"], 200);
  }
  public function filter(Request $request)
  {
    $formData = $request->all();

    if($request->Status != "0"){
         $quotes=quotes_status_master::where('quotesstatus', '=', $request->Status)->first();
            $quotes_staus_id= $quotes->quotesstatus_id;
      }else{
             $quotes_staus_id= "0";
      }
//echo"<pre>";print_r($quotes_staus_id);exit;
    if ($request->Company != "0" && $quotes_staus_id != "0") {

      $quotesfilter = Quotes::select('clients.client_name as client_name', 'quotes.quotes_id as quotes_id', 'quote_no', 'date', 'expires_on', 'quotes_status_master.quotesstatus', 'quotes_amount.totalamount', 'quotes.currencies_id as currencies_id')
        ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
        ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
        ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')
        ->where('quotes_status_id', $quotes_staus_id)
        ->where('company_id', $request->Company)
        ->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)
        ->get();




      $quoteviewArray = array();
      foreach ($quotesfilter as $key => $value) {
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
    } else if ($request->Company == "0" && $quotes_staus_id != "0") {
      $quotesfilter = Quotes::select('clients.client_name as client_name', 'quotes.quotes_id as quotes_id', 'quote_no', 'date', 'expires_on', 'quotes_status_master.quotesstatus', 'quotes_amount.totalamount', 'quotes.currencies_id as currencies_id')
        ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
        ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
        ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')

        ->where('quotes_status_id', $quotes_staus_id)
        ->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)
        ->get();

      $quoteviewArray = array();
      foreach ($quotesfilter as $key => $value) {
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
    } else if ($request->Company != "0" && $quotes_staus_id == "0") {
      $quotesfilter = Quotes::select('clients.client_name as client_name', 'quotes.quotes_id as quotes_id', 'quote_no', 'date', 'expires_on', 'quotes_status_master.quotesstatus', 'quotes_amount.totalamount', 'quotes.currencies_id as currencies_id')
        ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
        ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
        ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')
        ->where('company_id', $request->Company)

        ->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)

        ->get();
      $quoteviewArray = array();
      foreach ($quotesfilter as $key => $value) {
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
        //echo"<pre>";print_r($quoteviewArray);exit;

      }
    } else {
      $quotesfilter = Quotes::select('clients.client_name as client_name', 'quotes.quotes_id as quotes_id', 'quote_no', 'date', 'expires_on', 'quotes_status_master.quotesstatus', 'quotes_amount.totalamount', 'quotes.currencies_id as currencies_id')
        ->leftJoin('clients', 'quotes.client_id', '=', 'clients.id')
        ->leftJoin('quotes_amount', 'quotes.quotes_id', '=', 'quotes_amount.quotes_id')
        ->leftJoin('quotes_status_master', 'quotes.quotes_status_id', '=', 'quotes_status_master.quotesstatus_id')
        ->where('quotes.deleted_at', '=', NULL)->where('quotes.quote_no', '!=', NULL)

        ->get();
      $quoteviewArray = array();
      foreach ($quotesfilter as $key => $value) {
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
    }
    return response::json(['error' => false, 'message' => "success", "quotesviews" => $quoteviewArray], 200);
  }
}