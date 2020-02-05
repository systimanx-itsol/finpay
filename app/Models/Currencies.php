<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Currencies extends UuidModel
{
    
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $primaryKey = "id";
    protected $fillable = ['name','code','symbol', 'placement', 'decimal','thousands'];
    public $table = 'currencies';    
}
