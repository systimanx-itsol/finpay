<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_item_amount extends  UuidModel
{
    	use SoftDeletes;
  use Uuids;
  public $timestamps = true;
  public $incrementing = false;
    protected $primaryKey = "id";
	
	protected $fillable = ['invoice_id','item_id','tax', 'discount','total_amount'];
	 public $table = 'invoice_item_amounts';
}
 