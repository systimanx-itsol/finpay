<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\invoice;
use App\Models\Company;
use App\Models\Client;
use App\Models\invoice_item;
use DB;

use Elibyy\TCPDF\TCPDFHelper;
use PDF;
use TCPDF;



class ClientstatementController extends Controller
{

    /**
     *
     * @SWG\Post(
     *     path="/clientstatementpreview",
     *     description="clientstatementpreview Store",
     *     tags={"REPORT - CLIENTSTATEMENT"},
     *     summary="Client Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="client_id",
     *          description="Client Name",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="fromdate",
     *          description="From Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="todate",
     *          description="To Date",
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
    public function clientstatementpreview(Request $request)
    {
        $formData = $request->all();
        // echo "<pre>";
        // print_r($formData);
        // exit;
        $client_id = $formData['client_id'];

        $client = Client::where('client_name', $client_id)->first();

        $id =  $client->id;




        $company_profile = $request->company_profile;
        $clientid = $id;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        // echo "<pre>";
        // print_r($fromdate);
        // exit;

        // $clientstatement = DB::select("SELECT invoices.company_id,clients.id,clients.client_name,invoices.invoice_number,invoices.balance,invoices.total,invoices.discount,invoice_items.description FROM companies
        //                     LEFT JOIN invoices on invoices.company_id = companies.id
        //                     LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
        //                     LEFT JOIN clients on invoices.client_id = clients.id 
        //                     where invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and invoices.client_id = '$clientid' and '$fromdate' and '$todate'
        //                     GROUP BY invoices.company_id,clients.id,clients.client_name,invoices.invoice_number,invoices.balance,invoices.total,invoice_items.description,invoices.discount");


        $clientstatementpreview = DB::select("SELECT invoices.company_id,companies.company_name,clients.id, invoice_item_amounts.tax,invoice_amounts.item_sub_total,invoice_amounts.discount_amount,clients.client_name,invoices.invoice_number,invoices.date,invoices.total_paid_amount,invoices.balance,invoices.total,invoices.discount,invoice_notes.note,currencies.symbol,currencies.placement,currencies.thousands,currencies.decimal FROM companies
                            LEFT JOIN invoices on invoices.company_id = companies.id
                            LEFT JOIN invoice_notes on invoices.invoice_id = invoice_notes.invoice_id
                            LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
                            LEFT JOIN invoice_amounts on invoices.invoice_id = invoice_amounts.invoice_id
                            LEFT JOIN invoice_item_amounts on invoices.invoice_id = invoice_item_amounts.invoice_id
                            LEFT JOIN clients on invoices.client_id = clients.id 
                            LEFT JOIN currencies on invoices.currency_id = currencies.id
                            where invoices.invoice_number IS NOT NULL and companies.deleted_at IS NULL  and invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and invoices.client_id = '$clientid' and invoices.date >= '$fromdate' and invoices.date <= '$todate'
                            GROUP BY currencies.placement,currencies.thousands,currencies.decimal,invoices.company_id,currencies.symbol,companies.company_name,clients.id,clients.client_name,invoices.invoice_number,invoice_item_amounts.tax,invoice_amounts.item_sub_total,invoice_amounts.discount_amount,invoices.date,invoices.total_paid_amount,invoices.balance,invoices.total,invoices.discount,invoice_notes.note");

        // echo "<pre>";
        // print_r($clientstatementpreview);
        // exit;


        return response()->json(['status' => 1, 'message' => "success", "clientstatementpreview" => $clientstatementpreview], 200);
    }


    /**
     *
     * @SWG\Post(
     *     path="/clientstatement",
     *     description="clientstatement Store",
     *     tags={"REPORT - CLIENTSTATEMENT"},
     *     summary="Client Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="client_id",
     *          description="Client Name",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     *     @SWG\Parameter(
     *          name="fromdate",
     *          description="From Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="todate",
     *          description="To Date",
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
    public function clientstatement(Request $request)
    {
        $formData = $request->all();
        // echo "<pre>";
        // print_r($formData);
        // exit;
        $client_id = $formData['client_id'];

        $client = Client::where('client_name', $client_id)->first();

        $id =  $client->id;




        $company_profile = $request->company_profile;
        $clientid = $id;
        $fromdate = $request->fromdate;
        $todate = $request->todate;


        // $clientstatement = DB::select("SELECT invoices.company_id,clients.id,clients.client_name,invoices.invoice_number,invoices.balance,invoices.total,invoices.discount,invoice_items.description FROM companies
        //                     LEFT JOIN invoices on invoices.company_id = companies.id
        //                     LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
        //                     LEFT JOIN clients on invoices.client_id = clients.id 
        //                     where invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and invoices.client_id = '$clientid' and '$fromdate' and '$todate'
        //                     GROUP BY invoices.company_id,clients.id,clients.client_name,invoices.invoice_number,invoices.balance,invoices.total,invoice_items.description,invoices.discount");
        $company = Company::select('company_name', 'address', 'city', 'state', 'country', 'zipcode', 'mobile', 'website')
            ->where('id', $company_profile)->first();
        $client = Client::select('client_name')->where('id', $clientid)->first();

        $clientstatement = DB::select("SELECT invoices.company_id,companies.company_name,clients.id, invoice_item_amounts.tax,invoice_amounts.item_sub_total,invoice_amounts.discount_amount,clients.client_name,invoices.invoice_number,invoices.date,invoices.total_paid_amount,invoices.balance,invoices.total,invoices.discount,invoice_items.description,currencies.symbol,currencies.placement,currencies.thousands,currencies.decimal FROM companies
                            LEFT JOIN invoices on invoices.company_id = companies.id
                            LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
                            LEFT JOIN invoice_amounts on invoices.invoice_id = invoice_amounts.invoice_id
                            LEFT JOIN invoice_item_amounts on invoices.invoice_id = invoice_item_amounts.invoice_id
                            LEFT JOIN clients on invoices.client_id = clients.id 
                            LEFT JOIN currencies on invoices.currency_id = currencies.id
                            where invoices.invoice_number IS NOT NULL and companies.deleted_at IS NULL  and invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and invoices.client_id = '$clientid' and invoices.date >= '$fromdate' and invoices.date <= '$todate'
                            GROUP BY currencies.placement,currencies.thousands,currencies.decimal,invoices.company_id,currencies.symbol,companies.company_name,clients.id,clients.client_name,invoices.invoice_number,invoice_item_amounts.tax,invoice_amounts.item_sub_total,invoice_amounts.discount_amount,invoices.date,invoices.total_paid_amount,invoices.balance,invoices.total,invoices.discount,invoice_items.description");
        // echo "<pre>";
        // print_r($clientstatement);
        // exit;
        $pdf = new TCPDFHelper('L', 'mm', 'ANSI_A', true, 'UTF-8', false);
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->AddPage('L', 'A4');
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
                            </td> 
                           <td></td>
                            
                   
                        </tr>
                       
                    </table>
                            <br><br><br>

                             
    <h5 style="font-weight: bold;font-size:13px;text-align:center;text-transform:uppercase">' . $company->company_name . '</h5>
  <p style="font-weight: bold;font-size:10px;text-align:center;">
  '  . $company->address . ' ' . '
  <br>
  '  . $company->city . ' - ' . $company->zipcode . '
  <br>
   '  . $company->state . ' ' . '
  
    '  . $company->country . ' ' . '
    <br>
    '  . $company->mobile . ' ' . '
   
     '  . $company->website . ' ' . '
     <br></p>
 <h5 style="font-weight: bold;font-size:13px;text-align:center;text-transform:uppercase">Client Statement</h5>
<p style="font-weight: bold;font-size:10px;text-align:center;text-transform:uppercase">Financial Date' . ' (' . $fromdate . ' - ' . $todate . ' )' . '</p>   
          
 <table cellspacing="1" cellpadding="10" class="invoicesection">

        <br><br><br>

                        <tr>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Date</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Invoice</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Description</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Subtotal</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Discount</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Tax</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Total</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Paid</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Balance</td>
                      
                        </tr>';

        $body = '';
        for ($i = 0; $i < count($clientstatement); $i++) {
            $body .= '

                        <tr>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $clientstatement[$i]->date . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $clientstatement[$i]->invoice_number . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $clientstatement[$i]->description . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($clientstatement[$i]->symbol) . ($clientstatement[$i]->item_sub_total)  . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $clientstatement[$i]->discount . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $clientstatement[$i]->tax . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($clientstatement[$i]->symbol) . ($clientstatement[$i]->total) .  '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($clientstatement[$i]->symbol) . ($clientstatement[$i]->total_paid_amount)  . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($clientstatement[$i]->symbol) . ($clientstatement[$i]->balance)  . '</td>
                     
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
          
            </tr>

             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
          
            </tr>

             
             <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
          
            </tr>

            <tr>
                <th></th>
                <th> </th>
                <th></th>
                <th> </th>
            
            </tr>
            <br><br><br>
                      
                    </table>
                    <table  cellspacing="6" cellpadding="3" >
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                         </table>
                   
                  
              
    </body>';

        $tcpdf = $header . $body . $footer;
        $pdf->writeHTML($tcpdf, true, false, true, false, '');
        $file = $pdf->Output('ClientStatement.pdf', 'I');
        return $file;
    }
}
