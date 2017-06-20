<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Clinictoken;

class ClinictokenController extends Controller
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
        $clinictokens = Clinictoken::paginate(5);
        
        return view('clinictokens.index')->withClinictokens($clinictokens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->clinictoken == "" || $request->clinictoken == null) {
            $clinictoken = new Clinictoken;
            $clinictoken->clinictoken = str_random(6);
            $clinictoken->save();
        }else{
            $this->validate($request,[
                'clinictoken'=>'min:6|max:6'
                ]);
            $clinictoken = new clinictoken;
            $clinictoken->clinictoken = $request->clinictoken;
            $clinictoken->save();
        }
        

        return redirect()->route('clinictokens.index');
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
        $clinictoken = Clinictoken::find($id);
        $clinictoken->delete();

        return redirect()->route('clinictokens.index');
    }
}
