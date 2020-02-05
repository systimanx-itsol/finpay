<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMethod extends UuidModel
{
    public function children() {
        return $this->hasMany('App\Models\CategoryMethod','parentcategory','id')->where('status','=', 1);
    }
}
