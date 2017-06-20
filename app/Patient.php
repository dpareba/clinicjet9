<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $dates = ['dob','approxdob'];

    public function clinics(){
    	return $this->belongsToMany('App\Clinic')->withTimestamps();
    }

    public function visits(){
    	return $this->hasMany('App\Visit')->orderBy('created_at','desc');
    }
   
   // public function reports(){
   // 		return $this->hasMany('App\Report');
   // }
}
