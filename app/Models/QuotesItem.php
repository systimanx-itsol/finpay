<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class QuotesItem extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "item_id";
    protected $fillable = ['item_id', 'quote_id', 'product_id', 'product_name', 'tax_rate_value', 'description', 'quotessubtotal', 'quantity', 'price', 'tax_rate_id', 'percentage', 'status'];
    public $table = 'quotes_item';
}
