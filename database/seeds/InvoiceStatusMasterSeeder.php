<?php

use Illuminate\Database\Seeder;
use App\Models\Invoice_status_master;

class InvoiceStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data = [
        ['invoicestatus_id' =>1, 'invoicestatus' => "Draft", 'status' => 1],
        ['invoicestatus_id' =>2,'invoicestatus' => "Sent", 'status' => 1],
        ['invoicestatus_id' =>3,'invoicestatus' => "Paid", 'status' => 1],
        ['invoicestatus_id' =>4,'invoicestatus' => "Cancelled", 'status' => 1],
        ['invoicestatus_id' =>5,'invoicestatus' => "Unpaid", 'status' => 1],
        ['invoicestatus_id' =>6,'invoicestatus' => "Maild", 'status' => 1],
        ['invoicestatus_id' =>7,'invoicestatus' => "Over Due", 'status' => 1],
          
       ];
        //$invoice_status_master = invoice_status_master::create($data);       
	   foreach ($data as $instence) {
           $object = new Invoice_status_master;
           $object->invoicestatus = $instence['invoicestatus'];
           $object->status = $instence['status'];
           $object->save();
	   }
       }
   }

 