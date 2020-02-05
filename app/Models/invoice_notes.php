<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_notes extends UuidModel
{
    use SoftDeletes;
  use Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "note_id";
	
	protected $fillable = ['invoice_id', 'note', 'display_order','created_at' ];
	 public $table = 'invoice_notes';
}
 