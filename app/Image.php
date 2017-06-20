<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = ['report_id','file_name','file_size','file_mime','file_path','created_by'];

    public function report(){
    	return $this->belongsTo('App\Report');
    }
}
