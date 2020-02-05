<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaymentMethod extends UuidModel
{
  use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
  protected $primaryKey = "id";
	
  protected $fillable = ['id','name'];
  public $table = 'payment_methods';

}
