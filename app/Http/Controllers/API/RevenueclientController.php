<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\invoice;
use App\Models\Company;
use App\Models\Client;
use App\Models\Payment;
use DB;
use Elibyy\TCPDF\TCPDFHelper;
use PDF;
use TCPDF;


class RevenueclientController extends Controller
{


    /**
     *
     * @SWG\Post(
     *     path="/revenueclientpreview",
     *     description="revenueclientpreview Store",
     *     tags={"REPORT - REVENUECLIENT"},
     *     summary="Revenueclientpreview Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          description="Year",
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
    public function revenueclientpreview(Request $request)
    {
        $formData = $request->all();

        $company_profile = $request->company_profile;
        $year = $request->year;


        $revenueclientpreview =  DB::select("SELECT
	clients.client_name,currencies.symbol,currencies.placement 
	,SUM(IF(MONTH(payments.payment_date) = 1,payments.payment_amount,0)) January
	,SUM(IF(MONTH(payments.payment_date) = 2,payments.payment_amount,0)) February
	,SUM(IF(MONTH(payments.payment_date) = 3,payments.payment_amount,0)) March
	,SUM(IF(MONTH(payments.payment_date) = 4,payments.payment_amount,0)) April
	,SUM(IF(MONTH(payments.payment_date) = 5,payments.payment_amount,0)) May
	,SUM(IF(MONTH(payments.payment_date) = 6,payments.payment_amount,0)) June
	,SUM(IF(MONTH(payments.payment_date) = 7,payments.payment_amount,0)) July
	,SUM(IF(MONTH(payments.payment_date) = 8,payments.payment_amount,0)) August
	,SUM(IF(MONTH(payments.payment_date) = 9,payments.payment_amount,0)) September
	,SUM(IF(MONTH(payments.payment_date) = 10,payments.payment_amount,0)) October
	,SUM(IF(MONTH(payments.payment_date) = 11,payments.payment_amount,0)) November
	,SUM(IF(MONTH(payments.payment_date) = 12,payments.payment_amount,0)) December
    ,SUM(payments.payment_amount) Total
		FROM payments
		LEFT JOIN invoices on payments.invoice_id = invoices.invoice_id
		LEFT JOIN clients on invoices.client_id = clients.id
		LEFT JOIN currencies on invoices.currency_id = currencies.id
		where YEAR(payments.payment_date) = '$year' and invoices.company_id = '$company_profile' and invoices.deleted_at IS NULL and payments.deleted_at IS NULL
		GROUP BY clients.client_name,currencies.symbol,currencies.placement");
        // echo "<pre>";
        // print_r($revenueclientpreview);
        // exit;
        return response()->json(['status' => 1, 'message' => "success", "revenueclientpreview" => $revenueclientpreview], 200);
    }

    /**
     *
     * @SWG\Post(
     *     path="/revenueclient",
     *     description="revenueclient Store",
     *     tags={"REPORT - REVENUECLIENT"},
     *     summary="Client Store",
     *      @SWG\Parameter(
     *          name="company_profile",
     *          description="Company Profile",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          description="Year",
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
    public function revenueclient(Request $request)
    {
        $formData = $request->all();

        $company_profile = $request->company_profile;
        $year = $request->year;


        $revenueclient =  DB::select("SELECT
	clients.client_name,currencies.symbol,currencies.placement,companies.company_name
	,SUM(IF(MONTH(payments.payment_date) = 1,payments.payment_amount,0)) January
	,SUM(IF(MONTH(payments.payment_date) = 2,payments.payment_amount,0)) February
	,SUM(IF(MONTH(payments.payment_date) = 3,payments.payment_amount,0)) March
	,SUM(IF(MONTH(payments.payment_date) = 4,payments.payment_amount,0)) April
	,SUM(IF(MONTH(payments.payment_date) = 5,payments.payment_amount,0)) May
	,SUM(IF(MONTH(payments.payment_date) = 6,payments.payment_amount,0)) June
	,SUM(IF(MONTH(payments.payment_date) = 7,payments.payment_amount,0)) July
	,SUM(IF(MONTH(payments.payment_date) = 8,payments.payment_amount,0)) August
	,SUM(IF(MONTH(payments.payment_date) = 9,payments.payment_amount,0)) September
	,SUM(IF(MONTH(payments.payment_date) = 10,payments.payment_amount,0)) October
	,SUM(IF(MONTH(payments.payment_date) = 11,payments.payment_amount,0)) November
	,SUM(IF(MONTH(payments.payment_date) = 12,payments.payment_amount,0)) December
    ,SUM(payments.payment_amount) Total
FROM payments
LEFT JOIN invoices on payments.invoice_id = invoices.invoice_id
LEFT JOIN clients on invoices.client_id = clients.id
LEFT JOIN companies on invoices.company_id = companies.id
LEFT JOIN currencies on invoices.currency_id = currencies.id
where YEAR(payments.payment_date) = '$year' and invoices.company_id = '$company_profile' and invoices.deleted_at IS NULL and payments.deleted_at IS NULL
GROUP BY clients.client_name,currencies.symbol,currencies.placement,companies.company_name");

        // echo "<pre>amount";
        // print_r($revenueclient);
        // exit;

        // return response()->json(['status' => 1, 'message' => "success", "revenueclient" => $revenueclient], 200);

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
.amount
{
  font-size:10px !important;
  color:#000;
// }
                        
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
                        }table
                        {
                         max-width:50%;
                         overflow-x:scroll;
                         display:block;
                            
                        }
                    </style>
                    <h3 style="font-weight: bold;font-size:20px;text-align:center">Revenue Client</h3>
                                           <br>

            <table cellspacing="1" cellpadding="1" class="invoicesection" >

          
           
           
            <br><br><br>
<h1>hgjhhjhhj</h1>
                        <tr>
                           
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;>as</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;>1</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">2</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Mar</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Apr</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">May</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Jun</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Jul</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Aug</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Sep</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Oct</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Nov</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Dec</td>
                            <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd">Total</td>
                      
                        </tr>
                         ';

        $body = '';
        for ($i = 0; $i < count($revenueclient); $i++) {
            // echo "<pre>amount";
            // print_r($revenueclient[$i]->Total);
            // exit;
            $body .= '

                        <tr>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . $revenueclient[$i]->client_name .   '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->January . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->February . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->March . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->April . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->May . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->June . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->July . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . '</td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->August . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->September . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->October . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->November . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->December . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        <td class="amount" style="font-weight: bold;border-bottom:1px solid #ddd;">' . ($revenueclient[$i]->placement == 0 ? $revenueclient[$i]->symbol : '') . $revenueclient[$i]->Total . ($revenueclient[$i]->placement == 1 ? $revenueclient[$i]->symbol : '') . ' </td>
                        </tr>';
        }

        // echo "<pre>amount";
        // print_r($body);
        // exit;
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
        // echo "<pre>";
        // print_r($tcpdf);
        // exit;
        $pdf->writeHTML($tcpdf, true, false, true, false, '');

        $file = $pdf->Output('revenueclient.pdf', 'I');
        return $file;
    }
}
