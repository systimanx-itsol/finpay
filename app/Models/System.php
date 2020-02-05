<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class System extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    // public $incrementing = false;
    public $primaryKey = "id";
    protected $fillable = ['key','value'];
    public $table = 'systems';   
}
