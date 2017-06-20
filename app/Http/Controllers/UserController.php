<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use File;
use Image;

class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function profile(){
    	return view('users.profile');
    }

    public function updateAvatar(Request $request){
    	  if ($request->hasFile('file')) {
             $user = Auth::user();
             $photo = $user->avatar;
            if(File::exists(public_path('/avatar/docs/' . $photo)) && $photo !="default.jpg")
              File::delete(public_path('/avatar/docs/' . $photo)); //Delete file from storage

    	 	 $avatar = $request->file('file');
    	 	 $filename = time() . '.' . $avatar->getClientOriginalExtension();
    	 	 Image::make($avatar)->resize(300,300)->save( public_path('/avatar/docs/' . $filename) );
    	 	$user = Auth::user();
    		$user->avatar = $filename;
    	 	$user->save();
    	}

    	 //return redirect()->route('profile');
        //return redirect('home');
    }
}
