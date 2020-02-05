<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice_status_master extends UuidModel 
{
    
    use SoftDeletes;
  use Uuids;
  public $timestamps = true;
  public $incrementing = false;
    protected $primaryKey = "invoicestatus_id";
	
	protected $fillable = ['invoicestatus_id','invoicestatus','status'];
	 public $table = 'invoice_status_master';
}
 