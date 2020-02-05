<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\invoicetry;
use App\invoicetry_product;
use App\Models\Currencies;
use App\Models\Client;
use PDF;
use Auth;
use Input;
use Response;
use Elibyy\TCPDF\TCPDFHelper;
use File;
use TCPDF;

class InvoicetryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Currencies = Currencies::select('id', 'name', 'symbol', 'placement', 'decimal', 'thousands')->get();
  
  //echo"<pre>";print_r($Currencies);exit;
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
    // $currency= json_decode($CurrenciesArray);
    // echo"<pre>";print_r($CurrenciesArray);exit;
   }
   return response::json(['error' => false, 'message' => "success", "currencyDetails" => $CurrenciesArray], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //echo "<pre>";print_r($request->all());exit;
        
         $formData = $request->all();
$products=array();
$descriptions=array();
$quantities=array();
$prices=array();
$tax=array();
$totals=array();
$productarray=json_decode($request['productdata']);

// echo "<pre>";print_r($productarray[0] );exit;




	   
     $logoimage = ""; 
     $publicpath = "";
 if ($formData['image'] != "") {
            $image = $formData['image'];
            $name = $image->getClientOriginalName();
            $size = $image-> getSize();
            $image->move(public_path() . '/images/sample/', $name);
            $logoimage = url('/') . '/images/sample/' . $name;
             $publicpath = public_path('/') . '/images/sample/' . $name;
        } else{
        $logoimage = "";
        }

        // echo "<pre>";print_r($logoimage );exit;
            $invoicetry = [
                    
                       
                      "invoice_number" => $request->invoice_number,
                      "date" => $request->date,
                      "due_date" => $request->due_date,
                      "company_address" => $request->company_address,
                      "bill_to" => $request->bill_to,
                      "terms" => $request->terms,
                      "notes" =>  $request->notes,
                      "discount" =>  $request->discount,
                      "subtotal" => $request->subtotal,
                      "discountval" => $request->discountval,
                      "taxtotal" =>  $request->taxtotal,
                      "total" => $request->total,
                      "currency" => $request->currency,
                      "logo" => $logoimage
                      
                     
                ];

               
        
                   
     
                // $invoicetry_product = [
                    
                    
                      
                //       "product" =>$productarray[$i]->product,
                //       "description" => $productarray[$i]->description,
                //       "tax" => $productarray[$i]->tax,
                //       "quantity" => $productarray[$i]->quantity,
                //       "price" => $productarray[$i]->price,
                //       "total" =>  $productarray[$i]->total,
                     
                     
 
                
                // ];
                // echo "<pre>";print_r($productarray[$i]);exit;

	




$pdf = new TCPDFHelper('L', 'mm', 'ANSI_A', true, 'UTF-8', false);
 $pdf->SetMargins(10, 10, 10);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->AddPage('P', 'A4');
            $pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
            $pdf->startTransaction();







$header ='<html>
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
                            <img src="'.$logoimage.'" alt="HTML5 Icon" class="top" style="margin-top:-5px;width:80px;"></td>
                            <td></td>
                             <td rowspan="8"><h3>Company Address</h3>
                             <h4>'.$invoicetry['company_address'].'</h4>
                             </td>

                          
                        </tr>
                       
                    </table>
                            <br><br><br>

  <table cellspacing="6" cellpadding="3" class="invoicesection">
                   
 <tr>
 <td rowspan="8"><h3>Bill To</h3>
  <h4>'.$invoicetry['bill_to'].'</h4>
 </td>
 <td></td>
 <td></td>
 <td></td>

    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool"># Invoice Number</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">'.$invoicetry['invoice_number'].'</td>
    
  </tr>
  <tr>
   <td></td>
 <td></td>
 <td></td>
   <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Date</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">'.$invoicetry['date'].'</td>
  </tr>
   <tr>
    <td></td>
 <td></td>
 <td></td>
  <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Due Date</td>
    <td width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec">'.$invoicetry['due_date'].'</td>
  </tr>
             
                <br>
               
          </table>
            <table cellspacing="6" cellpadding="3" class="invoicesection">

          
           
           
            <br><br><br>

<tr>
                                                    <th width="20%" style="border:1px solid #000" class="invoicetool">Item</th>

                            <th width="30%" style="border:1px solid #000;font-size:8px" class="invoicetool">quantity</th>
                            <th width="15%" style="border:1px solid #000;font-size:8px" class="invoicetool">price</th>
                        <th width="18%" style="border:1px solid #000;font-size:8px" class="invoicetool">tax</th>
                        <th width="18%" style="border:1px solid #000;font-size:8px" class="invoicetool">Total</th>
                        </tr>
                         ';
                        
             $body = '';
             for($i=0; $i<count($productarray); $i++){
                 $body.='

                        <tr>
                       
                          <td style="border:1px solid #000;font-size:8px">'.$productarray[$i]->product.'</td>
                            <td style="border:1px solid #000;font-size:8px">'.$productarray[$i]->quantity.'</td>
                            <td style="border:1px solid #000;font-size:8px">'.$productarray[$i]->price.'</td>
                        <td style="border:1px solid #000;font-size:8px">'.$productarray[$i]->tax.' %</td>
                        <td style="border:1px solid #000;font-size:8px">'.$invoicetry['currency'].' '.$productarray[$i]->total.'</td>
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
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec"> '.$invoicetry['currency'].' '.$invoicetry['subtotal'].'</th>
            </tr>

             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Tax</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec"> '.$invoicetry['currency'].' '.$invoicetry['taxtotal'].'</th>
            </tr>

             
             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Discount</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec"> '.$invoicetry['currency'].' '.$invoicetry['discountval'].'</th>
            </tr>

            <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetool">Total</th>
            <th width="17%" style="border:1px solid #000;font-size:8px" class="invoicetoolsec"> '.$invoicetry['currency'].' '.$invoicetry['total'].'</th>
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
            <p><h2>Terms:-  '.$invoicetry['terms'].'</h2></p>
              <p><h2>Notes:-  '.$invoicetry['notes'].'</h2></p>
    </aside> </body>';
            $tcpdf=$header.$body.$footer;
             $pdf->writeHTML($tcpdf, true, false, true, false, '');
            if(File::exists($publicpath)) {
                 File::delete($publicpath);
            $file = $pdf->Output('invoice.pdf', 'I');
            return $file;


               
            
			
			
	
	

            //   return response::json(['error' => false, 'message' => trans('SUCCESS'), 'pdf_url' => $fileatt, 'download_name'=> $download_name], 200);

    }
    }

    
    // public function genratePFD($pdfData,$arrayData){
    //     $tcpdfhead ='<html>
    //    <style>
            
    //             *{
    //         border: 0;
    //         box-sizing: content-box;
    //         color: inherit;
    //         font-family: inherit;
    //         font-size: inherit;
    //         font-style: inherit;
    //         font-weight: inherit;
    //         line-height: inherit;
    //         list-style: none;
    //         margin: 0;
    //         padding: 0;
    //         text-decoration: none;
    //         vertical-align: top;
    //     }

    //     /* content editable */

    //     *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

    //     *[contenteditable] { cursor: pointer; }

    //     *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

    //     span[contenteditable] { display: inline-block; }

    //     /* heading */

    //     h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

    //     /* table */

    //     table { font-size: 75%; table-layout: fixed; width: 100%; }
    //     table { border-collapse: separate; border-spacing: 2px; }
    //     th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
    //     th, td { border-radius: 0.25em; border-style: solid; }
    //     th { background: #EEE; border-color: #BBB; }
    //     td { border-color: #DDD; }

    //     /* page */

    //     html { font: 16px/1 Open Sans; sans-serif; overflow: auto; padding: 0.5in; }
    //     html { background: #999; cursor: default; }

    //     body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
    //     body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

    //     /* header */

    //     header { margin: 0 0 3em; }
    //     header:after { clear: both; content: ""; display: table; }

    //     header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
    //     header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
    //     header address p { margin: 0 0 0.25em; }
    //     header span, header img { display: block; float: right; }
    //     header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
    //     header img { max-height: 100%; max-width: 100%; }
    //     header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

    //     /* article */

    //     article, article address, table.meta, table.inventory { margin: 0 0 3em; }
    //     article:after { clear: both; content: ""; display: table; }
    //     article h1 { clip: rect(0 0 0 0); position: absolute; }

    //     article address { float: left; font-size: 125%; font-weight: bold; }

    //     /* table meta & balance */

    //     table.meta, table.balance { float: right; width: 36%; }
    //     table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

    //     /* table meta */

    //     table.meta th { width: 40%; }
    //     table.meta td { width: 60%; }

    //     /* table items */

    //     table.inventory { clear: both; width: 100%; }
    //     table.inventory th { font-weight: bold; text-align: center; }

    //     table.inventory td:nth-child(1) { width: 26%; }
    //     table.inventory td:nth-child(2) { width: 38%; }
    //     table.inventory td:nth-child(3) { text-align: right; width: 12%; }
    //     table.inventory td:nth-child(4) { text-align: right; width: 12%; }
    //     table.inventory td:nth-child(5) { text-align: right; width: 12%; }

    //     /* table balance */

    //     table.balance th, table.balance td { width: 50%; }
    //     table.balance td { text-align: right; }

    //     /* aside */

    //     aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
    //     aside h1 { border-color: #999; border-bottom-style: solid; }

    //     /* javascript */

    //     .add, .cut
    //     {
    //         border-width: 1px;
    //         display: block;
    //         font-size: .8rem;
    //         padding: 0.25em 0.5em;	
    //         float: left;
    //         text-align: center;
    //         width: 0.6em;
    //     }

    //     .add, .cut
    //     {
    //         background: #9AF;
    //         box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    //         background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
    //         background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
    //         border-radius: 0.5em;
    //         border-color: #0076A3;
    //         color: #FFF;
    //         cursor: pointer;
    //         font-weight: bold;
    //         text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
    //     }

    //     .add { margin: -2.5em 0 0; }

    //     .add:hover { background: #00ADEE; }

    //     .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
    //     .cut { -webkit-transition: opacity 100ms ease-in; }

    //     tr:hover .cut { opacity: 1; }

    //     @media print {
    //         * { -webkit-print-color-adjust: exact; }
    //         html { background: none; padding: 0; }
    //         body { box-shadow: none; margin: 0; }
    //         span:empty { display: none; }
    //         .add, .cut { display: none; }
    //     }

    //     @page { margin: 0; }

    //         </style>
    //         <head>
    //             <meta charset="utf-8">
    //             <title>Invoice</title>
    //             <link rel="stylesheet" href="style.css">
    //             <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
    //             <script src="script.js"></script>
    //         </head>
    //         <body>
    //             <header>
    //                 <h1>Invoice</h1>
    //                 <address contenteditable>
    //                     <p>' . $invoicetry['bill_to'] . '</p>
    //                 </address>
    //                 <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
    //             </header>
    //             <article>
    //                 <h1>Recipient</h1>
    //                 <address contenteditable>
    //                     <p>' . $invoicetry['company_address'] . '</p>
    //                 </address>
    //                 <table class="meta">
    //                     <tr>
    //                         <th><span contenteditable>Invoice #</span></th>
    //                         <td><span contenteditable>' . $invoicetry['invoice_number'] . '</span></td>
    //                     </tr>
    //                     <tr>
    //                         <th><span contenteditable>Date</span></th>
    //                         <td><span contenteditable>' . $invoicetry['date'] . '</span></td>
    //                     </tr>
                        
    //                     <tr>
    //                         <th><span contenteditable>Due Date</span></th>
    //                         <td><span contenteditable>' . $invoicetry['due_date'] . '</span></td>
    //                     </tr>
                        
    //                 </table>
    //                 <table class="inventory">
    //                     <thead>
    //                         <tr>
    //                             <th><span contenteditable>Item</span></th>
    //                             <th><span contenteditable>Description</span></th>
    //                             <th><span contenteditable>Rate</span></th>
    //                             <th><span contenteditable>Quantity</span></th>
    //                             <th><span contenteditable>Price</span></th>
    //                         </tr>
    //                     </thead>
    //                     <tbody>';

    //                      foreach($productarray as $product); 

                    
    //                         <tr>
    //                             <td><a class="cut">-</a><span contenteditable>' . $product->product . '</span></td>
    //                             <td><span contenteditable>' .$product->description . '</span></td>
    //                             <td><span data-prefix>$</span><span contenteditable>' . $product->price . '</span></td>
    //                             <td><span contenteditable>' . $product->quantity . '</span></td>
    //                             <td><span data-prefix>$</span><span>' . $product->total . '</span></td>
    //                         </tr>
    //                    $tcpdffooder = '</tbody>
    //                 </table>
    //                 <a class="add">+</a>
    //                 <table class="balance">
    //                     <tr>
    //                         <th><span contenteditable>Total</span></th>
    //                         <td><span data-prefix>$</span><span>600.00</span></td>
    //                     </tr>
    //                     <tr>
    //                         <th><span contenteditable>Amount Paid</span></th>
    //                         <td><span data-prefix>$</span><span contenteditable>0.00</span></td>
    //                     </tr>
    //                     <tr>
    //                         <th><span contenteditable>Balance Due</span></th>
    //                         <td><span data-prefix>$</span><span>600.00</span></td>
    //                     </tr>
    //                 </table>
    //             </article>
    //             <aside>
    //                 <h1><span contenteditable>Additional Notes</span></h1>
    //                 <div contenteditable>
    //                     <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
    //                 </div>
    //             </aside>
    //         </body>
    //     </html>';
    //     str_replace("RED","pink",$arr)
    //     for($)
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
