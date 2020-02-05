<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_item extends  UuidModel 
{
     
	use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "item_id";
	
	protected $fillable = ['invoice_id','product_id','product_name', 'description', 'quantity', 'price', 'total','tax_value','tax_rate_id','created_at' ];
	 public $table = 'invoice_items';
}
  