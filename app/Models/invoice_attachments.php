<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_attachments extends UuidModel
{
    use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "Attachment_id";
	
	protected $fillable = ['invoice_id', 'file_name', 'file_type', 'file_size','file_path', 'created_at'];
	 public $table = 'invoice_attachments';
}
 