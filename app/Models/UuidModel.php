<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UuidModel extends Model
{
    
    use Uuids,SoftDeletes;
    public $incrementing = false;
    protected $guarded = [];
}
