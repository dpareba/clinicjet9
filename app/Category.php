<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function pathologies(){
    	return $this->hasMany('App\Pathology');
    }
}
