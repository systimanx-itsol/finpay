<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\invoice_item_amount;
use App\Models\invoice_amount;
use App\Models\Currencies;
use App\Models\invoice;
use App\Dashboard;
use App\Models\invoice_status_master;
use App\Models\System;
use Illuminate\Http\Request;
use DB;
use Input;
use Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
     * @SWG\Get(
     *          path="/getDashboard",
     *          tags={"DASHBOARD"},
     *          summary="Invoice Dashboard",
     *          operationId="cid",
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


        $notification = DB::select("SELECT expires_on,client_name,invoice_number,balance FROM invoices
                          INNER JOIN clients on invoices.client_id = clients.id
                          where invoices.deleted_at IS NULL 
                        AND invoices.balance != 0.00 and invoices.expires_on <= CURDATE() 
                                  ");
   $notification2 = array("||","|| Due Date: ","|| InvoiceNumber: ");
    
                                   //echo"<pre>";print_r($notification2);exit;

            

                        //echo"<pre>";print_r($noty);exit;

        //invoice

        $System = System::select('id', 'key', 'value')->get();
        $SystemArray1 = array();
        $SystemArray2 = array();
        $financialdate = "";
        $base_currency = ""; 
        foreach ($System as $key => $system) {
            if ($system->key == "financial_date") {
                $financialdate = $system->value;
                //   echo "<pre>";print_r($System);exit;

            }
            $SystemArray1[$system->key] = $system->value;
        }
        foreach ($System as $key => $currency) {
            if ($currency->key == "base_currency") {
                $base_currency = $currency->value;
            }
            $SystemArray2[$currency->key] = $currency->value;
        }


        $currency = Currencies::where('id', $base_currency)->first();

        $symbol = $currency->symbol;
        $placement = $currency->placement;
        $decimal = $currency->decimal;
        $thousands = $currency->thousands;
        $financial_year = date("Y-m-d", strtotime($financialdate . '+1 year'));

        $monthname = ['January', 'Febuary', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December'];


        $piechart = DB::select("SELECT monthname(invoices.date) month, SUM(invoices.total) total FROM invoices 
                                    where invoices.deleted_at IS NULL 
                                    AND invoices.date >= '$financialdate' and invoices.date < '$financial_year'    GROUP BY monthname(invoices.date) 
                                  ");
        // echo"<pre>";print_r($piechart);exit;
        $Month = [];
        $Total = [];

        foreach ($piechart as $key => $system) {

            $Total[$system->month] = $system->total;
        }

        if (!empty($Total)) {
            if (isset($Total['January'])) {
            } else {
                $Total['January'] = 0;
            }
        } else {
            $Total['January'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['February'])) {
            } else {
                $Total['February'] = 0;
            }
        } else {
            $Total['February'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['March'])) {
            } else {
                $Total['March'] = 0;
            }
        } else {
            $Total['March'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['April'])) {
            } else {
                $Total['April'] = 0;
            }
        } else {
            $Total['April'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['May'])) {
            } else {
                $Total['May'] = 0;
            }
        } else {
            $Total['May'] = 0;
        };

        if (!empty($Total)) {
            if (isset($Total['June'])) {
            } else {
                $Total['June'] = 0;
            }
        } else {
            $Total['June'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['July'])) {
            } else {
                $Total['July'] = 0;
            }
        } else {
            $Total['July'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['August'])) {
            } else {
                $Total['August'] = 0;
            }
        } else {
            $Total['August'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['September'])) {
            } else {
                $Total['September'] = 0;
            }
        } else {
            $Total['September'] = 0; 
        }

        if (!empty($Total)) {
            if (isset($Total['October'])) {
            } else {
                $Total['October'] = 0;
            } 
        } else {
            $Total['October'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['November'])) {
            } else {
                $Total['November'] = 0;
            }
        } else {
            $Total['November'] = 0;
        }

        if (!empty($Total)) {
            if (isset($Total['December'])) {
            } else {
                $Total['December'] = 0;
            }
        } else {
            $Total['December'] = 0;
        }

        $monthtotal = [


            $Total['January'],
            $Total['February'],
            $Total['March'],
            $Total['April'],
            $Total['May'],
            $Total['June'],
            $Total['July'],
            $Total['August'],
            $Total['September'],
            $Total['October'],
            $Total['November'],
            $Total['December'],





        ];
        //echo "<pre>";print_r($test);exit;
        $invoicedraft = DB::select("SELECT  SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL  and invoices.date >= '$financialdate' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Draft' 
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");
        if (!empty($invoicedraft)) {
            if (isset($invoicedraft[0])) {
                if (isset($invoicedraft[0]->total)) {
                    $invoicedraft = $invoicedraft[0]->total;
                } else {
                    $invoicedraft = 0;
                }
            } else {
                $invoicedraft = 0;
            }
        } else {
            $invoicedraft = 0;
        }
        $invoicesent = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL  and invoices.date >= '$financialdate' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Sent'
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");

        if (!empty($invoicesent)) {
            if (isset($invoicesent[0])) {
                if (isset($invoicesent[0]->total)) {
                    $invoicesent = $invoicesent[0]->total;
                } else {
                    $invoicesent = 0;
                }
            } else {
                $invoicesent = 0;
            }
        } else {
            $invoicesent = 0;
        }
        $invoicepayment = DB::select("SELECT SUM(payments.payment_amount) total FROM payments 
                                where payments.deleted_at IS NULL  and   payments.payment_date >= '$financialdate' and payments.payment_date<=CURDATE()");
        if (!empty($invoicepayment)) {
            if (isset($invoicepayment[0])) {
                if (isset($invoicepayment[0]->total)) {
                    $invoicepayment = $invoicepayment[0]->total;
                } else {
                    $invoicepayment = 0;
                }
            } else {
                $invoicepayment = 0;
            }
        } else {
            $invoicepayment = 0;
        }
        $duedate = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) expires_on FROM invoices 
                               LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                where invoices.deleted_at IS NULL and invoices.expires_on<=CURDATE() and  invoice_status_master.invoicestatus != 'Cancelled' and  invoice_status_master.invoicestatus != 'Draft' and invoice_status_master.invoicestatus != 'Paid' and invoices.expires_on <= CURDATE() and   invoices.expires_on >= '$financialdate'   GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus");

        if (!empty($duedate)) {
            if (isset($duedate[0])) {
                if (isset($duedate[0]->expires_on)) {
                    $duedate = $duedate[0]->expires_on;
                } else {
                    $duedate = 0;
                }
            } else {
                $duedate = 0;
            }
        } else {
            $duedate = 0;
        }
        return response()->json(['status' => 1, 'message' => "success", 'notification2' => $notification2,'notification' => $notification,  'financial_date' => $financialdate, 'financial_year' => $financial_year, "month" => $monthname, "total" => $monthtotal, "symbol" => $symbol, "placement" => $placement, "decimal" => $decimal, "thousands" => $thousands, "invoicedraft" => $invoicedraft, "invoicesent" => $invoicesent, 'invoicepayment' => $invoicepayment, 'duedate' => $duedate], 200);
    }

     /**
     * @SWG\Post(
     *          path="/customdate",
     *          tags={"DASHBOARD"},
     *          summary="Invoice customdate",
     *          operationId="Did",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *  @SWG\Parameter(
     *          name="from_date",
     *          description="From Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="to_date",
     *          description="To Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
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
    // invoice
    public function CustomDate(Request $request)
    {


        $formData = $request->all();
        //echo "<pre>";print_r($formData);exit;
        $from_date = $request->from;
        $to_date = $request->todate;
        if ($from_date != 0) {
            $invoicedraft = DB::select("SELECT  invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL  and invoices.date >= '$from_date' and invoices.date<=  '$to_date' and invoice_status_master.invoicestatus = 'Draft'
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");
            if (!empty($invoicedraft)) {
                if (isset($invoicedraft[0])) {
                    if (isset($invoicedraft[0]->total)) {
                        $invoicedraft = $invoicedraft[0]->total;
                    } else {
                        $invoicedraft = 0;
                    }
                } else {
                    $invoicedraft = 0;
                }
            } else {
                $invoicedraft = 0;
            }
            //echo "<pre>";print_r($invoicedraft);exit;
            $invoicesent = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL  and invoices.date >= '$from_date' and invoices.date<=  '$to_date' and invoice_status_master.invoicestatus = 'Sent'
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");
            if (!empty($invoicesent)) {
                if (isset($invoicesent[0])) {
                    if (isset($invoicesent[0]->total)) {
                        $invoicesent = $invoicesent[0]->total;
                    } else {
                        $invoicesent = 0;
                    }
                } else {
                    $invoicesent = 0;
                }
            } else {
                $invoicesent = 0;
            }
            $invoicepayment = DB::select("SELECT SUM(payments.payment_amount) total FROM payments 
                                where payments.deleted_at IS NULL  and   payments.payment_date >= '$from_date' and payments.payment_date<='$to_date'");
            if (!empty($invoicepayment)) {
                if (isset($invoicepayment[0])) {
                    if (isset($invoicepayment[0]->total)) {
                        $invoicepayment = $invoicepayment[0]->total;
                    } else {
                        $invoicepayment = 0;
                    }
                } else {
                    $invoicepayment = 0;
                }
            } else {
                $invoicepayment = 0;
            }


            $duedate = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) expires_on FROM invoices 
                               LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                where invoices.deleted_at IS NULL  and  invoice_status_master.invoicestatus != 'Cancelled' and  invoice_status_master.invoicestatus != 'Draft' and invoice_status_master.invoicestatus != 'Paid' and invoices.expires_on >= '$from_date' and invoices.expires_on <= CURDATE()   GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus");
            if (!empty($duedate)) {
                if (isset($duedate[0])) {
                    if (isset($duedate[0]->expires_on)) {
                        $duedate = $duedate[0]->expires_on;
                    } else {
                        $duedate = 0;
                    }
                } else {
                    $duedate = 0;
                }
            } else {
                $duedate = 0;
            }
            //echo "<pre>";print_r($duedate);exit;
            //echo "<pre>";print_r($invoicedraft);
            // echo "<pre>";print_r($invoicesent);
            // echo "<pre>";print_r($invoicepayment);
            // echo "<pre>";print_r($duedate);exit;

        } else {

            $System = System::select('id', 'key', 'value')->get();
            $SystemArray1 = array();
            $SystemArray2 = array();
            $financialdate = "";
            $base_currency = "";
            foreach ($System as $key => $system) {
                if ($system->key == "financial_date") {
                    $financialdate = $system->value;
                }
                $SystemArray1[$system->key] = $system->value;
            }
            foreach ($System as $key => $currency) {
                if ($currency->key == "base_currency") {
                    $base_currency = $currency->value;
                }
                $SystemArray2[$currency->key] = $currency->value;
            }
            $invoicedraft = DB::select("SELECT  SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL  and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Draft' 
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");
            if (!empty($invoicedraft)) {
                if (isset($invoicedraft[0])) {
                    if (isset($invoicedraft[0]->total)) {
                        $invoicedraft = $invoicedraft[0]->total;
                    } else {
                        $invoicedraft = 0;
                    }
                } else {
                    $invoicedraft = 0;
                }
            } else {
                $invoicedraft = 0;
            }
            $invoicesent = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) total FROM invoices 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                  where invoices.deleted_at IS NULL   and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Sent'
                                  GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus
                                  ");
            if (!empty($invoicesent)) {
                if (isset($invoicesent[0])) {
                    if (isset($invoicesent[0]->total)) {
                        $invoicesent = $invoicesent[0]->total;
                    } else {
                        $invoicesent = 0;
                    }
                } else {
                    $invoicesent = 0;
                }
            } else {
                $invoicesent = 0;
            }
            $invoicepayment = DB::select("SELECT SUM(payments.payment_amount) total FROM payments 
                                where payments.deleted_at IS NULL   and payments.payment_date<=CURDATE()");
            if (!empty($invoicepayment)) {
                if (isset($invoicepayment[0])) {
                    if (isset($invoicepayment[0]->total)) {
                        $invoicepayment = $invoicepayment[0]->total;
                    } else {
                        $invoicepayment = 0;
                    }
                } else {
                    $invoicepayment = 0;
                }
            } else {
                $invoicepayment = 0;
            }
            $duedate = DB::select("SELECT invoices.invoice_status_id, invoice_status_master.invoicestatus, SUM(invoices.balance) expires_on FROM invoices 
                               LEFT JOIN invoice_status_master on invoices.invoice_status_id=invoice_status_master.invoicestatus_id
                                where invoices.deleted_at IS NULL and invoices.expires_on<=CURDATE() and  invoice_status_master.invoicestatus != 'Cancelled' and  invoice_status_master.invoicestatus != 'Draft' and invoice_status_master.invoicestatus != 'Paid' and invoices.expires_on <= CURDATE()    GROUP BY invoices.invoice_status_id, invoice_status_master.invoicestatus");
            //echo "<pre>";print_r($duedate);exit;
            if (!empty($duedate)) {
                if (isset($duedate[0])) {
                    if (isset($duedate[0]->expires_on)) {
                        $duedate = $duedate[0]->expires_on;
                    } else {
                        $duedate = 0;
                    }
                } else {
                    $duedate = 0;
                }
            } else {
                $duedate = 0;
            }
            //echo "<pre>";print_r($duedate);exit;
        }
        return response()->json(['status' => 1, 'message' => "success", "invoicedraft" => $invoicedraft, "invoicesent" => $invoicesent, 'invoicepayment' => $invoicepayment, 'duedate' => $duedate], 200);
    }

    /**
     * @SWG\Get(
     *          path="/getstatus",
     *          tags={"DASHBOARD"},
     *          summary="Quotes Dashboard",
     *          operationId="cid",
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
    public function quoteindex()

    {
        $System = System::select('id', 'key', 'value')->get();
        $SystemArray1 = array();
        $SystemArray2 = array();
        $base_currency = "";
        $financial_date = "";
        foreach ($System as $key => $system) {
            if ($system->key == "base_currency") {
                $base_currency = $system->value;
            }

            $SystemArray1[$system->key] = $system->value;
        }
        foreach ($System as $key => $financial) {
            if ($financial->key == "financial_date") {
                $financial_date = $financial->value;
            }
            $SystemArray2[$financial->key] = $financial->value;
        }



        $currencies = Currencies::where('id', $base_currency)->first();
        $symbol =  $currencies->symbol;
        $placement =  $currencies->placement;
        $thousands = $currencies->thousands;
        // $decimal = $currencies->decimal;
        // echo "<pre>thousands";
        // print_r($thousands);
        // exit;


        $yeartodatedraft = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Draft'
                                and quotes.date >= '$financial_date' and quotes.date <= CURDATE()
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");

        if (!empty($yeartodatedraft)) {
            if (isset($yeartodatedraft[0])) {
                if (isset($yeartodatedraft[0]->totalamount)) {
                    $yeartodatedraft = $yeartodatedraft[0]->totalamount;
                } else {
                    $yeartodatedraft = 0;
                }
            } else {
                $yeartodatedraft = 0;
            }
        } else {
            $yeartodatedraft = 0;
        }




        // echo "<pre>";
        // print_r($yeartodatedraft);
        // exit;



        $yeartodatesent = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Sent'
                                and quotes.date >= '$financial_date' and quotes.date <= CURDATE()
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");



        if (!empty($yeartodatesent)) {
            if (isset($yeartodatesent[0])) {
                if (isset($yeartodatesent[0]->totalamount)) {
                    $yeartodatesent = $yeartodatesent[0]->totalamount;
                } else {
                    $yeartodatesent = 0;
                }
            } else {
                $yeartodatesent = 0;
            }
        } else {
            $yeartodatesent = 0;
        }


        $yeartodateapproved = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Approved'
                                and quotes.date >= '$financial_date' and quotes.date <= CURDATE()
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");




        if (!empty($yeartodateapproved)) {
            if (isset($yeartodateapproved[0])) {
                if (isset($yeartodateapproved[0]->totalamount)) {
                    $yeartodateapproved = $yeartodateapproved[0]->totalamount;
                } else {
                    $yeartodateapproved = 0;
                }
            } else {
                $yeartodateapproved = 0;
            }
        } else {
            $yeartodateapproved = 0;
        }


        $yeartodaterejected = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Rejected'
                                and quotes.date >= '$financial_date' and quotes.date <= CURDATE()
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


        if (!empty($yeartodaterejected)) {
            if (isset($yeartodaterejected[0])) {
                if (isset($yeartodaterejected[0]->totalamount)) {
                    $yeartodaterejected = $yeartodaterejected[0]->totalamount;
                } else {
                    $yeartodaterejected = 0;
                }
            } else {
                $yeartodaterejected = 0;
            }
        } else {
            $yeartodaterejected = 0;
        }


        // $invoicesent = DB::select("SELECT invoices.summary, invoice_status_master.invoicestatus, SUM(invoices.total) total FROM invoices
        //                           LEFT JOIN invoice_status_master on invoices.summary = invoice_status_master.invoicestatus_id
        //                           where invoices.deleted_at IS NULL  and invoices.date >= '$financial_date' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Sent'
        //                           GROUP BY invoices.summary, invoice_status_master.invoicestatus");


        // $invoicesent = DB::select("SELECT clients.id, invoices.client_id, invoices.summary, invoice_status_master.invoicestatus, SUM(invoices.total) total FROM clients
        //                           LEFT JOIN invoices on clients.id = invoices.client_id 
        //                           LEFT JOIN invoice_status_master on invoices.summary = invoice_status_master.invoicestatus_id
        //                           where clients.deleted_at IS NULL and invoices.deleted_at IS NULL  and invoices.date >='$financial_date' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Sent'
        //                           GROUP BY clients.id, invoices.client_id, invoices.summary, invoice_status_master.invoicestatus");


        $invoicesentQ = DB::select("SELECT  invoice_status_master.invoicestatus, SUM(invoices.total) total FROM clients
                                  LEFT JOIN invoices on clients.id = invoices.client_id 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id  = invoice_status_master.invoicestatus_id
                                  where clients.deleted_at IS NULL and invoices.deleted_at IS NULL  and invoices.date >='$financial_date' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Sent'
                                  GROUP BY invoices.invoice_status_id ,invoice_status_master.invoicestatus");

        // SELECT  clients.client_name, invoices.client_id, invoices.summary, invoice_status_master.invoicestatus, SUM(invoices.total) total FROM clients
        //                                   LEFT JOIN invoices on clients.id = invoices.client_id 
        //                                   LEFT JOIN invoice_status_master on invoices.summary = invoice_status_master.invoicestatus_id
        //                                   where clients.deleted_at IS NULL  and invoices.date >= '2019-01-01' and invoices.date<= '2019-12-10' and invoice_status_master.invoicestatus = 'Sent'
        //                                   GROUP BY clients.client_name, invoices.summary, invoice_status_master.invoicestatus


        if (!empty($invoicesentQ)) {
            if (isset($invoicesentQ[0])) {
                if (isset($invoicesentQ[0]->total)) {
                    $invoicesentQ = $invoicesentQ[0]->total;
                }
            }
        }

        //    echo "<pre>invoicesent";
        //          print_r($invoicesentQ);
        //          exit;

        // if (!empty($invoicesent)) {
        //     if (isset($invoicesent[0])) {
        //         if (isset($invoicesent[0]->total)) {
        //             $invoicesent = $invoicesent[0]->total;
        //         } else {
        //             $invoicesent = 0;
        //         }
        //     } else {
        //         $invoicesent = 0;
        //     }
        // } else {
        //     $invoicesent = 0;
        // }

        // $Sent = [];


        // echo "<pre>invoicesent";
        // print_r($invoicesent);
        // exit;

        $invoicepaid = DB::select("SELECT  invoice_status_master.invoicestatus, SUM(invoices.total) total FROM clients
                                  LEFT JOIN invoices on clients.id = invoices.client_id 
                                  LEFT JOIN invoice_status_master on invoices.invoice_status_id = invoice_status_master.invoicestatus_id
                                  where clients.deleted_at IS NULL and invoices.deleted_at IS NULL  and invoices.date >='$financial_date' and invoices.date<= CURDATE() and invoice_status_master.invoicestatus = 'Paid'
                                  GROUP BY  invoice_status_master.invoicestatus");


        if (!empty($invoicepaid)) {
            if (isset($invoicepaid[0])) {
                if (isset($invoicepaid[0]->total)) {
                    $invoicepaid = $invoicepaid[0]->total;
                }
            }
        }


        // if (!empty($invoicepaid)) {
        //     if (isset($invoicepaid[0])) {
        //         if (isset($invoicepaid[0]->total)) {
        //             $invoicepaid = $invoicepaid[0]->total;
        //         } else {
        //             $invoicepaid = 0;
        //         }
        //     } else {
        //         $invoicepaid = 0;
        //     }
        // } else {
        //     $invoicepaid = 0;
        // }
        // echo "<pre>sent";
        // print_r($invoicesent);
        // exit;


        return response()->json(['status' => 'error', 'message' => "success", 'invoicesentQ' => $invoicesentQ, 'invoicepaid' =>  $invoicepaid,  'yeartodatedraft' => $yeartodatedraft, 'yeartodatesent' => $yeartodatesent, 'yeartodateapproved' => $yeartodateapproved, 'yeartodaterejected' => $yeartodaterejected,  'symbol' => $symbol, 'placement' => $placement, 'thousands' => $thousands], 200);
    }

       /**
     * @SWG\Post(
     *          path="/customdaterange",
     *          tags={"DASHBOARD"},
     *          summary="Quotes customdaterange",
     *          operationId="Did",
     *          @SWG\Parameter(
     *             name="Authorization",
     *             in="header",
     *             description="auth number",
     *             required=true,
     *             type="string"
     *      ),
     *  @SWG\Parameter(
     *          name="from_date",
     *          description="From Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="to_date",
     *          description="To Date",
     *          required=false,
     *          type="string",in="formData",
     *      ),
     * 
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
    public function CustomDateRange(Request $request)
    {

        $System = System::select('id', 'key', 'value')->get();
        $SystemArray1 = array();
        $SystemArray2 = array();
        $base_currency = "";
        $financial_date = "";
        foreach ($System as $key => $system) {
            if ($system->key == "base_currency") {
                $base_currency = $system->value;
            }

            $SystemArray1[$system->key] = $system->value;
        }
        foreach ($System as $key => $financial) {
            if ($financial->key == "financial_date") {
                $financial_date = $financial->value;
            }
            $SystemArray2[$financial->key] = $financial->value;
        }



        $currencies = Currencies::where('id', $base_currency)->first();
        $symbol =  $currencies->symbol;
        $placement =  $currencies->placement;
        $thousands = $currencies->thousands;

        $formData = $request->all();


        $from_date = $request->from;
        $to_date = $request->todate;
//         echo "<pre>";print_r($from_date);
//  echo "<pre>";print_r($to_date);exit;
      
        // if ($from_date != 0) {

        //     $customdaterange = DB::select("SELECT SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
        //                         LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
        //                         LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
        //                         where quotes_amount.deleted_at IS NULL and quotes.date >= '$from_date' and quotes.date <=  '$to_date' 
        //                         GROUP BY quotes.quotes_status_id,quotes_status_master.quotesstatus_id");
        // } else {


        //     $customdaterange = DB::select("SELECT  SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
        //                           LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id  
        //                           LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
        //                           where quotes_amount.deleted_at IS NULL
        //                          GROUP BY quotes.quotes_status_id,quotes_status_master.quotesstatus_id");
        // }




        if ($from_date != 0) {

            $customdaterangedraft = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Draft'
                                and quotes.date >='$from_date' and quotes.date <= '$to_date'
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangedraft)) {
                if (isset($customdaterangedraft[0])) {
                    if (isset($customdaterangedraft[0]->totalamount)) {
                        $customdaterangedraft = $customdaterangedraft[0]->totalamount;
                    } else {
                        $customdaterangedraft = 0;
                    }
                } else {
                    $customdaterangedraft = 0;
                }
            } else {
                $customdaterangedraft = 0;
            }


            $customdaterangesent = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Sent'
                                and quotes.date >='$from_date' and quotes.date <= '$to_date'
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangesent)) {
                if (isset($customdaterangesent[0])) {
                    if (isset($customdaterangesent[0]->totalamount)) {
                        $customdaterangesent = $customdaterangesent[0]->totalamount;
                    } else {
                        $customdaterangesent = 0;
                    }
                } else {
                    $customdaterangesent = 0;
                }
            } else {
                $customdaterangesent = 0;
            }


            // echo "<pre>invoicesent";
            //      print_r($customdaterangesent);
            //          exit;

            $customdaterangeapproved = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Approved'
                                and quotes.date >='$from_date' and quotes.date <= '$to_date'
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangeapproved)) {
                if (isset($customdaterangeapproved[0])) {
                    if (isset($customdaterangeapproved[0]->totalamount)) {
                        $customdaterangeapproved = $customdaterangeapproved[0]->totalamount;
                    } else {
                        $customdaterangeapproved = 0;
                    }
                } else {
                    $customdaterangeapproved = 0;
                }
            } else {
                $customdaterangeapproved = 0;
            }



            $customdaterangerejected = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Rejected'
                                and quotes.date >='$from_date' and quotes.date <= '$to_date'
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");

            if (!empty($customdaterangerejected)) {
                if (isset($customdaterangerejected[0])) {
                    if (isset($customdaterangerejected[0]->totalamount)) {
                        $customdaterangerejected = $customdaterangerejected[0]->totalamount;
                    } else {
                        $customdaterangerejected = 0;
                    }
                } else {
                    $customdaterangerejected = 0;
                }
            } else {
                $customdaterangerejected = 0;
            }
        } else {

            $customdaterangedraft = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Draft'
                             
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangedraft)) {
                if (isset($customdaterangedraft[0])) {
                    if (isset($customdaterangedraft[0]->totalamount)) {
                        $customdaterangedraft = $customdaterangedraft[0]->totalamount;
                    } else {
                        $customdaterangedraft = 0;
                    }
                } else {
                    $customdaterangedraft = 0;
                }
            } else {
                $customdaterangedraft = 0;
            }


            $customdaterangesent = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Sent'
                            
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangesent)) {
                if (isset($customdaterangesent[0])) {
                    if (isset($customdaterangesent[0]->totalamount)) {
                        $customdaterangesent = $customdaterangesent[0]->totalamount;
                    } else {
                        $customdaterangesent = 0;
                    }
                } else {
                    $customdaterangesent = 0;
                }
            } else {
                $customdaterangesent = 0;
            }


            $customdaterangeapproved = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Approved'
                              
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");


            if (!empty($customdaterangeapproved)) {
                if (isset($customdaterangeapproved[0])) {
                    if (isset($customdaterangeapproved[0]->totalamount)) {
                        $customdaterangeapproved = $customdaterangeapproved[0]->totalamount;
                    } else {
                        $customdaterangeapproved = 0;
                    }
                } else {
                    $customdaterangeapproved = 0;
                }
            } else {
                $customdaterangeapproved = 0;
            }



            $customdaterangerejected = DB::select("SELECT quotes.quotes_status_id, quotes_status_master.quotesstatus, SUM(quotes_amount.totalamount) totalamount FROM quotes_amount
                                LEFT JOIN quotes on quotes_amount.quotes_id = quotes.quotes_id 
                                LEFT JOIN quotes_status_master on quotes.quotes_status_id = quotes_status_master.quotesstatus_id
                                where quotes_amount.deleted_at IS NULL and quotes_status_master.quotesstatus = 'Rejected'
                                -- and quotes.date >='$from_date' and quotes.date <= '$to_date'
                                GROUP BY quotes.quotes_status_id, quotes_status_master.quotesstatus");

            if (!empty($customdaterangerejected)) {
                if (isset($customdaterangerejected[0])) {
                    if (isset($customdaterangerejected[0]->totalamount)) {
                        $customdaterangerejected = $customdaterangerejected[0]->totalamount;
                    } else {
                        $customdaterangerejected = 0;
                    }
                } else {
                    $customdaterangerejected = 0;
                }
            } else {
                $customdaterangerejected = 0;
            }
        }




        return response()->json(['status' => 1, 'message' => "success", "symbol" => $symbol, "thousands" => $thousands, "placement" => $placement, "yeartodatedraft" => $customdaterangedraft, "yeartodatesent" => $customdaterangesent, "yeartodateapproved" => $customdaterangeapproved, "yeartodaterejected" => $customdaterangerejected], 200);
    }

   
}
