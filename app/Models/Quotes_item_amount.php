<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class quotes_item_amount extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "quotes_item_amount_id";
    protected $fillable = ['quotes_item_id','quotes_id','tax_before_total','tax','discount','total_amount'];
    public $table = 'quotes_item_amount';
}
