<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class quotes_amount extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "quotes_amount_id";
    protected $fillable = ['quotes_amount_id','quotes_id','totalamount','quotes_id','itemsubtotal','discount','itemtaxtotal'];
    public $table = 'quotes_amount';
}
