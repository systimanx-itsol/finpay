<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 

class invoicetry extends Models\UuidModel
{
   use SoftDeletes;
     use Models\Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "id";
	
             
	protected $fillable = ['invoice_number', 'company_address', 'bill_to','date','due_date', 'terms','footer','total','balance','currency','logo'];
	 public $table = 'invoicetries';

}
