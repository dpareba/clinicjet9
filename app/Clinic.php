<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
	
    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function patients(){
    	return $this->belongsToMany('App\Patient');
    }

    public function visits(){
    	return $this->hasMany('App\Visit');
    }
}
