<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function visit(){
    	return $this->belongsTo('App\Visit');
    }

    // public function patient(){
    // 	return $this->belongsTo('App\Patient');
    // }

    public function images(){
    	return $this->hasMany('App\Image');
    }
}
