<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Passkey;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str; //Added
use Illuminate\Http\Request; //Added
use Illuminate\Auth\Events\Registered; //Added
use Mail; //Added
use App\Mail\ConfirmationEmail; //Added
use App\Speciality;//added

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        $specialities = Speciality::all();
        return view('auth.register')->withSpecialities($specialities);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['doctype']=="RECEPTIONIST") {
           return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:10|max:10',
            'doctype' => 'required'
            ]);
       }else{
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|min:10|max:10',
            'doctype' => 'required',
            'speciality' => 'required'
            ]);
    }



}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
         if ($data['doctype']=="RECEPTIONIST") {
            return User::create([
            'name' => Str::upper($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'speciality_id' => "73",
            'doctype' => $data['doctype'] 
            ]);
        }else{
            return User::create([
            'name' => Str::upper($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'speciality_id' => $data['speciality'],
            'doctype' => $data['doctype'] 
            ]);
        }
        
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($user->email)->send(new ConfirmationEmail($user));

        // return back()->with('status','We have sent an account activation link to your email-id.');

        return redirect()->route('login')->withStatus('Please click on the activatation link we have sent to your e-mail id inorder to activate your account.');
    }

    public function confirmEmail($token){
        User::whereToken($token)->firstOrFail()->hasVerified();

        return redirect('login')->with('status','Your email is now verified, Please Login');
    }
}
