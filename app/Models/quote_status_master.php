<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class quotes_status_master extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "quotesstatus_id";
    protected $fillable = ['quotesstatus_id','quotesstatus','status'];
    public $table = 'quotes_status_master';
}
