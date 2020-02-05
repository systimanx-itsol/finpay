<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class tryDemo extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $primaryKey = "id";
    protected $fillable = ['name','email'];
    public $table = 'tryDemos';   
}
