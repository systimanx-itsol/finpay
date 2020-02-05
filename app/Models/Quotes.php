<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;



class Quotes extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "quotes_id";
    protected $fillable = ['quotes_id', 'client_id', 'user_id', 'company_id', 'currencies_id', 'date', 'quote_template', 'quote_no', 'expires_on', 'quotes_status_id','total_amount', 'discountpercentage', 'terms', 'footer', 'status'];
    public $table = 'quotes';
}
