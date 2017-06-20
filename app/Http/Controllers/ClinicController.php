<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\State;
use App\User;
use Auth;
use App\Clinic;
use App\Clinictoken;
use App\Newclinictoken;
use Illuminate\Support\Str;

class ClinicController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function check(){
        //Session::flash('message','Hello');

        if (User::find(Auth::user()->id)->clinics()->first() == null) {
           return redirect()->route('newuser');
       }else{
        return redirect()->route('clinics.index');
    }
    
}

public function clinicInput(){
    return view('clinics.input');
}

public function clin(Request $request){

    $this->validate($request,[
        'clinictoken'=>'required'
        ]);
}

public function cliniccheck(Request $request){


    if((User::find(Auth::user()->id)->clinics()->where(['cliniccode'=>$request->cliniccode])->first())==null){
        $this->validate($request,[
            'cliniccode'=>'required|digits:4|exists:clinics,cliniccode'
            // 'clinictoken'=>'required|exists:clinictokens,clinictoken|max:255',
            ],[
            'cliniccode.required'=>'The Clinic Code is required to be filled in.',
            'cliniccode.digits'=>'The Clinic Code must consist of 4 digits',
            'cliniccode.exists'=>'Clinic with the entered code does not exist.' ,
            // 'clinictoken.required'=>'Clinic Token cannot be left blank!',
            // 'clinictoken.exists'=>'Invalid Clinic Token!'           
            ]);
    }else{
        $this->validate($request,[
            'cliniccode'=>'required|digits:4|exists:clinics,cliniccode|unique:clinics,cliniccode'
            // 'clinictoken'=>'required|exists:clinictokens,clinictoken|max:255',
            ],[
            'cliniccode.required'=>'The Clinic Code is required to be filled in.',
            'cliniccode.digits'=>'The Clinic Code must consist of 4 digits',
            'cliniccode.exists'=>'Clinic with the entered code does not exist.',
            'cliniccode.unique'=>'Clinic is already registered.',
            // 'clinictoken.required'=>'Clinic Token cannot be left blank!',
            // 'clinictoken.exists'=>'Invalid Clinic Token!'           
            ]);
    }

    $clinic = Clinic::where(['cliniccode'=>$request->cliniccode])->first();
    $user = User::find(Auth::user()->id);
    // if ($clinic->isRemoteClinic) {
    //     $user->isRemoteDoc = true;
    //     $user->save();
    // }else{
    //     $user->isRemoteDoc = false;
    //     $user->save();
    // }

    $clinic->users()->save($user);

    // Clinictoken::where(['clinictoken'=>$request->clinictoken])->delete();

    Session::flash('message','Success!!');
    Session::flash('text','New Clinic Added successfully!!');
    Session::flash('type','success');

            //return redirect()->route('check');
    return redirect()->route('clinics.index');
}

public function showClinic($id){
    $clinic = Clinic::find($id);

    return view('clinics.showclinic')->withClinic($clinic);
}

public function newUser(){
    return view('clinics.newuser');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = User::find(Auth::user()->id)->clinics()->get();

        return view('clinics.index')->withClinics($clinics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('clinics.create')->withStates($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $this->validate($request,[
            'name'=>'required|max:255|unique:clinics,name',
            // 'newclinictoken'=>'required|exists:newclinictokens,newclinictoken|max:255',
            // 'cliniclocation'=>'required',
            'clinictype'=>'required|max:255',
            'address'=>'required|unique:clinics,address',
            'state'=>'required|max:50',
            'city'=>'required|max:255',
            'pin'=>'required|integer|digits:6',
            'phoneprimary'=>'required|digits:10|unique:clinics,phoneprimary|unique:clinics,phonealternate',
            //'phoneprimarylandarea'=>'required',
            //'phoneprimarylandtel'=>'required',
            'phonealternate'=>'digits:10|unique:clinics,phonealternate|unique:clinics,phoneprimary',
            'email'=>'email|unique:clinics,email'
            ],[
            'name.required'=>'Clinic Name is required',
            'name.unique'=>'A Clinic by this name is already registered.',
            // 'newclinictoken.required'=>'Clinic Token cannot be left blank!',
            // 'newclinictoken.exists'=>'Invalid Clinic Token!',
            // 'cliniclocation.required'=>'Kindly Enter the Clinic Location',
            'clinictype.required'=>'Type of Clinic is required.',
            'address.required'=>'Clinic Address is required',
            'address.unique'=>'A Clinic with this address is already Registered',
            'state.required'=>'State field cannot be left blank',
            'city.required'=>'City field cannot be left blank',
            'pin.required'=>'Pincode cannot be blank',
            'pin.integer'=>'Invalid Pincode Format',
            'pin.digits'=>'Invalid Pincode Format',
            'phoneprimary.required'=>'Primary Phone Number of clinic is required',
            'phoneprimary.digits'=>'Phone Number field must contain 10 digits',
            'phoneprimary.unique'=>'A Clinic with this Phone Number is already Registered',
            'phonealternate.digits'=>'Phone Number field must contain 10 digits',
            'phonealternate.unique'=>'A Clinic with this Phone Number is already Registered',
            'email.unique'=>'A Clinic with this email is already Registered'
            ]);

        $user = User::find(Auth::user()->id);
        $clinic = new Clinic;
        $clinic->name = Str::upper($request->name);
    //     if ($request->cliniclocation == "Kenya") {
    //        $clinic->isRemoteClinic = true;
    //        $user->isRemoteDoc = true;
    //        $user->save();
    //    }else{
    //     $clinic->isRemoteClinic = false;
    //     $user->isRemoteDoc = false;
    //     $user->save();
    // }
        $clinic->address = Str::upper($request->address);
        $clinic->clinictype = Str::upper($request->clinictype);
        $clinic->state = Str::upper($request->state);
        $clinic->city = Str::upper($request->city);
        $clinic->pin = $request->pin;
        $clinic->phoneprimary = $request->phoneprimary;
        $clinic->phoneprimarylandarea = $request->phoneprimarylandarea;
        $clinic->phoneprimarylandtel = $request->phoneprimarylandtel;
        $clinic->phonealternate = $request->phonealternate;
        $clinic->email = $request->email;
        $clinic->website = $request->website;
        $clinic->cliniccode = rand(1000,9999);
        $clinic->clinicadmin_id = Auth::user()->id;
        $clinic->save();
        $clinic->users()->attach($user);

    // Newclinictoken::where(['newclinictoken'=>$request->newclinictoken])->delete();

        Session::flash('message','Success!!');
        Session::flash('text','New Clinic Registered successfully!!');
        Session::flash('type','success');

        return redirect()->route('clinics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
