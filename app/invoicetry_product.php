<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes; 

class invoicetry_product extends Models\UuidModel
{
    use SoftDeletes;
  use Models\Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "id";
	
             
	protected $fillable = ['invoicetry_id', 'product','description', 'quantity' ,'price','tax','total'];
	 public $table = 'invoicetry_products';

}
