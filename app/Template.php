<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
