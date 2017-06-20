<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VideoController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function initiateVideoCall(){
    	return view('videocall.initiate');
    }
}
