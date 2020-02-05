<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends UuidModel
{
    use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "payment_id";
	
	protected $fillable = ['invoice_id','payment_amount','payment_date','balance','paymenttype_id', 'note'];
	 public $table = 'payments';
}
 