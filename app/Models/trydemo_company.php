<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class trydemo_company extends Model
{
     use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $primaryKey = "id";
    protected $fillable = ['company_name','name','email'];
    public $table = 'trydemo_companies';  
}
