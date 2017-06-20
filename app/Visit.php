<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $dates = ['nextvisit'];

    public function patient(){
    	return $this->belongsTo('App\Patient');
    }

    public function clinic(){
    	return $this->belongsTo('App\Clinic');
    }

    public function reports(){
    	return $this->hasMany('App\Report');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function pathologies(){
        return $this->belongsToMany('App\Pathology');
    }

    public function prescriptions(){
        return $this->hasMany('App\Prescription');
    }
}
