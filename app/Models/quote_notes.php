<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class quote_notes extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $incrementing = false;
    public $softdelete = true;
    public $primaryKey = "note_id";
    protected $fillable = ['quotes_id','note'];
    public $table = 'quote_notes';
}
