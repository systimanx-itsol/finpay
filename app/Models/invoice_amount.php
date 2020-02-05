<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_amount extends  UuidModel
{
    use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "id";
	
	protected $fillable = ['invoice_id','item_sub_total','item_tax_total', 'discount_amount', 'total_amount', 'created_at' ];
	 public $table = 'invoice_amounts';
}
 
