<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;

use App\Models\Company;
use DB;

use Elibyy\TCPDF\TCPDFHelper;
use PDF;
use TCPDF;

class PaymentcollectedController extends Controller
{

    /**
     *
     * @SWG\Post(
     *     path="/paymentcollectedpreview",
     *     description="paymentcollectedpreview Store",
     *     tags={"REPORT - PAYMENTCOLLECTED"},
     *     summary="Paymentcollectedpreview Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     * 
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
    public function paymentcollectedpreview(Request $request)
    {
        $formData = $request->all();


        $company_profile = $request->company_profile;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $paymentcollectedpreview = DB::select("SELECT currencies.symbol,currencies.placement,currencies.decimal,currencies.thousands,companies.company_name,payments.payment_date,clients.client_name,payment_methods.name,payments.payment_amount,invoices.invoice_number,invoice_notes.note,invoices.total_paid_amount FROM companies
                            LEFT JOIN invoices on invoices.company_id = companies.id
                            LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
                            LEFT JOIN clients on invoices.client_id = clients.id 
                            LEFT JOIN payments on payments.invoice_id = invoices.invoice_id
                            LEFT JOIN payment_methods on payments.paymenttype_id = payment_methods.id
                            LEFT JOIN currencies on invoices.currency_id = currencies.id
                            LEFT JOIN invoice_notes on invoices.invoice_id = invoice_notes.invoice_id
                            where companies.deleted_at IS NULL and payments.deleted_at IS NULL and invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and payments.payment_date >= '$fromdate' and payments.payment_date <= '$todate'
                            GROUP BY currencies.symbol,currencies.decimal,currencies.thousands,currencies.placement,companies.company_name,clients.client_name,payments.payment_amount,payments.payment_date,clients.client_name,invoices.invoice_number,payment_methods.name,invoice_number,invoice_notes.note,invoices.total_paid_amount");

        // echo "<pre>date";
        // print_r($paymentcollected);
        // exit;

        // SELECT invoices.company_id,clients.client_name,payment_methods.name,invoices.invoice_number,invoice_notes.note,invoices.total_paid_amount FROM companies
        //                             LEFT JOIN invoices on invoices.company_id = companies.id
        //                             LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
        //                             LEFT JOIN clients on invoices.client_id = clients.id 
        //                             LEFT JOIN payments on payments.invoice_id = invoices.invoice_id
        //                             LEFT JOIN payment_methods on payments.paymenttype_id = payment_methods.id
        //                             LEFT JOIN invoice_notes on invoices.invoice_id = invoice_notes.invoice_id
        //                             where invoices.deleted_at IS NULL and invoices.company_id = "HCL" and invoices.client_id = "malathi" and "2019-12-01" and "2019-12-31"
        //                             GROUP BY invoices.company_id,clients.client_name,invoices.invoice_number,payment_methods.name,invoice_number,invoice_notes.note,invoices.total_paid_amount
        // echo "<pre>";
        // print_r($paymentcollectedpreview);
        // exit;

        return response()->json(['status' => 1, 'message' => "success", "paymentcollectedpreview" => $paymentcollectedpreview], 200);
    }

    /**
     *
     * @SWG\Post(
     *     path="/paymentcollected",
     *     description="paymentcollected Store",
     *     tags={"REPORT - PAYMENTCOLLECTED"},
     *     summary="paymentcollected Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     * 
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
    public function paymentcollected(Request $request)
    {
        $formData = $request->all();
        // echo "<pre>";
        // print_r($formData);
        // exit;

        $company_profile = $request->company_profile;
        $fromdate = $request->fromdate;
        $todate = $request->todate;

        // $companyprofile = invoice::where('invoice_id', $company_profile)->first();
        // echo "<pre>";
        // print_r($companyprofile);
        // exit;

        // $company_id =  $company->company_id;
        // echo "<pre>";
        // print_r($company_id);
        // exit;

        $company = Company::select('company_name', 'address', 'city', 'state', 'country', 'zipcode', 'mobile', 'website')
            ->where('id', $company_profile)->first();
        // echo "<pre>";
        // print_r($company);
        // exit;

        $paymentcollected = DB::select("SELECT currencies.symbol,currencies.placement,currencies.decimal,currencies.thousands,companies.company_name,payments.payment_date,clients.client_name,payment_methods.name,payments.payment_amount,invoices.invoice_number,invoice_notes.note,invoices.total_paid_amount FROM companies
                            LEFT JOIN invoices on invoices.company_id = companies.id
                            LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
                            LEFT JOIN clients on invoices.client_id = clients.id 
                            LEFT JOIN payments on payments.invoice_id = invoices.invoice_id
                            LEFT JOIN payment_methods on payments.paymenttype_id = payment_methods.id
                            LEFT JOIN currencies on invoices.currency_id = currencies.id
                            LEFT JOIN invoice_notes on invoices.invoice_id = invoice_notes.invoice_id
                            where companies.deleted_at IS NULL and payments.deleted_at IS NULL and invoices.deleted_at IS NULL and invoices.company_id = '$company_profile' and payments.payment_date >= '$fromdate' and payments.payment_date <= '$todate'
                            GROUP BY currencies.symbol,currencies.decimal,currencies.thousands,currencies.placement,companies.company_name,clients.client_name,payments.payment_amount,payments.payment_date,clients.client_name,invoices.invoice_number,payment_methods.name,invoice_number,invoice_notes.note,invoices.total_paid_amount");

        // echo "<pre>";
        // print_r($paymentcollected);
        // exit;


        // SELECT invoices.company_id,clients.client_name,payment_methods.name,invoices.invoice_number,invoice_notes.note,invoices.total_paid_amount FROM companies
        //                             LEFT JOIN invoices on invoices.company_id = companies.id
        //                             LEFT JOIN invoice_items on invoices.invoice_id = invoice_items.invoice_id
        //                             LEFT JOIN clients on invoices.client_id = clients.id 
        //                             LEFT JOIN payments on payments.invoice_id = invoices.invoice_id
        //                             LEFT JOIN payment_methods on payments.paymenttype_id = payment_methods.id
        //                             LEFT JOIN invoice_notes on invoices.invoice_id = invoice_notes.invoice_id
        //                             where invoices.deleted_at IS NULL and invoices.company_id = "HCL" and invoices.client_id = "malathi" and "2019-12-01" and "2019-12-31"
        //                             GROUP BY invoices.company_id,clients.client_name,invoices.invoice_number,payment_methods.name,invoice_number,invoice_notes.note,invoices.total_paid_amount
        $pdf = new TCPDFHelper('L', 'mm', 'ANSI_A', true, 'UTF-8', false);
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetFont('helvetica', '', 9);
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
 <h5 style="font-weight: bold;font-size:13px;text-align:center;text-transform:uppercase">Payment Collected</h5>
<p style="font-weight: bold;font-size:10px;text-align:center;text-transform:uppercase">Financial Date' . ' (' . $fromdate . ' - ' . $todate . ' )' . '</p>  
          
                                                
            <table cellspacing="1" cellpadding="10" class="invoicesection">

          
           
           
            <br><br><br>

                        <tr>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Date</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Invoice</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Client</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Paymentmethod</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Note</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">Total</td>
                        </tr>
                         ';

        $body = '';
        for ($i = 0; $i < count($paymentcollected); $i++) {
            $body .= '

                <tr>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $paymentcollected[$i]->payment_date . '</td>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $paymentcollected[$i]->invoice_number . '</td>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $paymentcollected[$i]->client_name . '</td>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $paymentcollected[$i]->name . '</td>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $paymentcollected[$i]->note . '</td>
                 <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($paymentcollected[$i]->placement == 0 ? $paymentcollected[$i]->symbol : '') . ($paymentcollected[$i]->total_paid_amount) . ' ' . ($paymentcollected[$i]->placement == 1 ? $paymentcollected[$i]->symbol : '') . '</td>
                                  
                     
                        </tr>';
        }


        $footer = '</table>

                  
                    <br><br>
               
                
                  
    </body>';

        $tcpdf = $header . $body . $footer;
        // echo "<pre>";
        // print_r($tcpdf);
        // exit;
        $pdf->writeHTML($tcpdf, true, false, true, false, '');

        $file = $pdf->Output('PaymentCollected.pdf', 'I');
        return $file;




        // return response()->json(['status' => 1, 'message' => "success", "paymentcollected" => $paymentcollected], 200);
    }
}
