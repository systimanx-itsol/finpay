<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    
    
  use Models\Uuids;
  public $timestamps = false;
  public $incrementing = false;
    protected $primaryKey = "id";
	
             
	protected $fillable = ['user_id'];
	 public $table = 'dashboards';


}
