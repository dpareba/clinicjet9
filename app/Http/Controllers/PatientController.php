<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use App\Patient;
use App\Clinic;
use App\Pathology;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str; //Added
use App\State;

class PatientController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$roles = User::find(Auth::user()->id)->roles()->get();

            // $clinicid = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first()->id;
            // $patients = Clinic::find($clinicid)->patients;
        $patients = Patient::all();
        return view('patients.index')->withPatients($patients);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('patients.create1')->withStates($states);
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
        if ($request->cbage == "on") {
            $this->validate($request,[
            'approxage'=>'required',
            'name'=>'required|max:255',
            //'midname'=>'required|max:255',
            'midname'=>'max:255',
            'surname'=>'required|max:255',
            'dob'=>'date_format:d/m/Y|before:tomorrow',
            'gender'=>'required|max:6',
            'bloodgroup'=>'required|max:10',
            'allergies'=>'required',
            'address'=>'required',
            'patientstate'=>'required',
            'patientcity'=>'required',
            'patientpin'=>'required|min:6|max:6',
            // 'phoneprimary'=>'required|digits:10|unique:patients,phoneprimary',
            // 'phonealternate'=>'required|digits:10|unique:patients,phonealternate',
            'phoneprimary'=>'required|digits:10',
            'phonealternate'=>'required|digits:10',
            'email'=>'email'
            ],[
            'approxage.required'=>'Approximate age of patient not entered',
            'name.required'=>'First Name is required to be entered',
            //'midname.required'=>'Middle Name is required to be entered',
            'surname.required'=>'Surname is required to be entered',
            'name.alpha'=>'The Name may only contain alphabets',
            'allergies.required'=>'Please enter know allergies.Enter Not known otherwise.',
            'phoneprimary.required'=>'Primary Phone Number is compulsory',
            'phoneprimary.digits'=>'Phone number needs to contain 10 digits',
            // 'phoneprimary.unique'=>'Patient with this phone number is already registered',
            'phonealternate.required'=>'Emergency Phone Number is compulsory',
            'phonealternate.digits'=>'Phone number needs to contain 10 digits',
            // 'phonealternate.unique'=>'Patient with this phone number is already registered',
            'dob.date'=>'The Date of Birth should be in mm/dd/yyyy format.',
            'dob.before'=>'The Date of Birth cannot be later than the date today.'
            ]);
        }else{
        $this->validate($request,[
            'name'=>'required|max:255',
            'midname'=>'max:255',
            'surname'=>'required|max:255',
            'dob'=>'date_format:d/m/Y|before:tomorrow',
            'gender'=>'required|max:6',
            'bloodgroup'=>'required|max:10',
            'allergies'=>'required',
            'address'=>'required',
            'patientstate'=>'required',
            'patientcity'=>'required',
            'patientpin'=>'required|min:6|max:6',
            // 'phoneprimary'=>'required|digits:10|unique:patients,phoneprimary',
            // 'phonealternate'=>'required|digits:10|unique:patients,phonealternate',
            'phoneprimary'=>'required|digits:10',
            'phonealternate'=>'required|digits:10',
            'email'=>'email'
            ],[
            'name.required'=>'First Name is required to be entered',
            //'midname.required'=>'Middle Name is required to be entered',
            'surname.required'=>'Surname is required to be entered',
            'name.alpha'=>'The Name may only contain alphabets',
            'allergies.required'=>'Please enter know allergies.Enter Not known otherwise.',
            'phoneprimary.required'=>'Primary Phone Number is compulsory',
            'phoneprimary.digits'=>'Phone number needs to contain 10 digits',
            //'phoneprimary.unique'=>'Patient with this phone number is already registered',
            'dob.date'=>'The Date of Birth should be in mm/dd/yyyy format.',
            'dob.before'=>'The Date of Birth cannot be later than the date today.'
            ]);
            }

        //$cliniccode = Session::get('cliniccode');
        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        //dd($clinicid);
        //$clinic = Clinic::find($clinicid);
       // dd($clinic);
        $patient = new Patient;
        $patient->name = Str::upper($request->name);
        $patient->midname = Str::upper($request->midname);
        $patient->surname = Str::upper($request->surname);
        if ($request->dob == "") {
            $input = '01/01/1900';
        }else{
            $input = $request->dob;
        }
        if($request->cbage == "on"){
            $patient->isapproxage = true;
            $approxdobinput = $request->approxdob;
            $patient->approxage = $request->approxage;
        }else{
            $patient->isapproxage = false;
            $approxdobinput = '01/01/1900';
            $patient->approxage = '';
        }
        //$format = 'm/d/Y';
        $format = 'd/m/Y';
        $date = Carbon::createFromFormat($format,$input);
        $patient->dob = $date;
        $approxdate = Carbon::createFromFormat($format,$approxdobinput);
        $patient->approxdob = $approxdate;
        $patient->gender = Str::upper($request->gender);
        $patient->phoneprimary = $request->phoneprimary;
        $patient->phonealternate = $request->phonealternate;
        $patient->email = $request->email;
        $patient->address = Str::upper($request->address);
        $patient->patientstate = Str::upper($request->patientstate);
        $patient->patientcity = Str::upper($request->patientcity);
        $patient->patientpin = Str::upper($request->patientpin);
        $patient->allergies = Str::upper($request->allergies);
        $patient->bloodgroup = $request->bloodgroup;
        $patient->patientcode = rand(1000,9999);
        $patient->idproof = $request->idproof;
        $patient->created_by = Auth::user()->id;
        $patient->save();
        $patient->clinics()->attach($clinic);

        Session::flash('message','Success!!');
        Session::flash('text','New Patient Added to Clinic successfully!!');
        Session::flash('type','success');
        Session::flash('timer','5000');

        return redirect()->route('patients.index');
    }

    public function showVisits(Request $request){
        $patient = Patient::findOrFail($request->patient_id);
        //dd($patient);
        // $dt1 = Carbon::create($patient->created_at);
        // $dt = Carbon::toDateString($dt1);
        //$dt = $patient->created_at->diffForHumans();
        $user = User::find($patient->created_by);
        //$visits = $patient->visits;
        return view('visits.show')->withPatient($patient)->withUser($user);
    }

    public function createconsult($id){
        $patient = Patient::findOrFail($id);
        $user = User::find($patient->created_by);
        //$pathologies = Pathology::all();
        $pathologies = Pathology::where('user_id','=','1')->orWhere('user_id','=',Auth::user()->id)->get();
        return view('patients.createconsult')->withPatient($patient)->withUser($user)->withPathologies($pathologies);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        //dd($patient);
        return view('patients.show')->withPatient($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patients.edit')->withPatient($patient);
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
       $this->validate($request,[
        'name'=>'required|max:255',
        'midname'=>'required|max:255',
        'surname'=>'required|max:255',
        'gender'=>'required|max:6',
        'bloodgroup'=>'required|max:10',
        'phoneprimary'=>'max:15',
        'phonealternate'=>'max:15',
        'email'=>'email'
        ],[
        'name.required'=>'Full Name is required to be entered',
        'name.alpha'=>'The Name may only contain alphabets'
        ]);

       $patient = Patient::find($id);
       $patient->name = $request->name;
       $patient->midname = $request->midname;
       $patient->surname = $request->surname;
       $patient->gender = $request->gender;
       $patient->phoneprimary = $request->phoneprimary;
       $patient->phonealternate = $request->phonealternate;
       $patient->email = $request->email;
       $patient->address = $request->address;
       $patient->allergies = $request->allergies;
       $patient->bloodgroup = $request->bloodgroup;
       $patient->idproof = $request->idproof;
       $patient->save();

       Session::flash('message','Success!!');
       Session::flash('text','Patient Details updated successfully!!');
       Session::flash('type','success');
       Session::flash('timer','5000');

       return redirect()->route('patients.show',$patient->id);

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
