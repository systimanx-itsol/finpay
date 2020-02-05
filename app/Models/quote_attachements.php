<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class quote_attachements extends UuidModel
{
    use SoftDeletes;
    use Uuids;
    public $timestamps = true;
    public $softdelete = true;
    public $incrementing = false;
    public $primaryKey = "attachment_id";
    protected $fillable = ['quotes_id','file_name','file_type','file_size','file_path'];
    public $table = 'quote_attachements';
}
